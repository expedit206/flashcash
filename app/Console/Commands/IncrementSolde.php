<?php
namespace App\Console\Commands;

use App\Models\Compte;
use Illuminate\Console\Command;
use Carbon\Carbon;

class IncrementSolde extends Command
{
    protected $signature = 'solde:increment';
    protected $description = 'Incrémente le solde principal de chaque compte un jour après la souscription au pack';

    public function handle()
    {
        // Récupère tous les comptes avec leurs packs
        $comptes = Compte::with('pack')->get();

        foreach ($comptes as $compte) {
            // Vérifie si un jour est passé depuis la dernière incrémentation
            $now = Carbon::now();
            $subscribedAt = $compte->created_at; // Date de souscription

            if ($compte->last_incremented_at === null) {
                // Met à jour la date de la dernière incrémentation à la date de souscription
                $compte->last_incremented_at = $subscribedAt;
                $compte->save();
            }

            // Vérifie si 24 heures se sont écoulées depuis la dernière incrémentation
            if ($subscribedAt->diffInDays($now) >= 1 && ($now->diffInDays($compte->last_incremented_at) >= 1)) {
                // Calcul de 10% du montant du pack
                $augmentation = $compte->pack->montant * 0.10;

                // Incrémente le solde actuel de l'utilisateur de 10% du montant du pack
                $compte->solde_actuel += $augmentation;

                // Met à jour la date de la dernière incrémentation
                $compte->last_incremented_at = $now;
                $compte->save();
            }
        }

        $this->info('Le solde de tous les comptes éligibles a été incrémenté de 10%.');
    }
}
