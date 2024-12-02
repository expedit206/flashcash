<?php
// app/Http/Controllers/ParrainageController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Deposit;
use App\Models\Produit;
use App\Models\ProduitUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParrainageController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();
        $solde_total = $user->solde_total;

        // Calcul des revenus de commission
        $totalCommissions = Commission::where('user_id', $user->id)->sum('amount');

        // Récupérer les filleuls de l'utilisateur (VIP 1)
        $vip1 = User::where('parrain_id', $user->id)->get();
        $totalFirstInvestmentVip1 = $this->calculateTotalFirstInvestments($vip1);
        // Récupérer les filleuls des VIP 1 (VIP 2)
        $vip2 = User::whereIn('parrain_id', $vip1->pluck('id'))->get();
        $totalFirstInvestmentVip2 = $this->calculateTotalFirstInvestments($vip2);

        // Récupérer les filleuls des VIP 2 (VIP 3)
        $vip3 = User::whereIn('parrain_id', $vip2->pluck('id'))->get();
        $totalFirstInvestmentVip3 = $this->calculateTotalFirstInvestments($vip3);

        return view('parrainage.index', compact(
            'totalCommissions',
            'totalFirstInvestmentVip1',
            'totalFirstInvestmentVip2',
            'totalFirstInvestmentVip3',
            'vip1',
            'vip2',
            'vip3',
            'user',
            'solde_total'
        ));
    }

    public function showFilleul()
    {
        $user = auth()->user();
        $niveau = request('niveau');
        $niveaux = $this->getFilleuls($user);

        // Récupérer les premiers dépôts pour chaque niveau
        $totalFirstInvestmentNiveau1 = $this->calculateTotalFirstInvestments($niveaux[1]);
        $totalFirstInvestmentNiveau2 = $this->calculateTotalFirstInvestments($niveaux[2]);
        $totalFirstInvestmentNiveau3 = $this->calculateTotalFirstInvestments($niveaux[3]);

        return view('parrainage.filleuls', compact(
            'niveaux',
            'niveau',
            'totalFirstInvestmentNiveau1',
            'totalFirstInvestmentNiveau2',
            'totalFirstInvestmentNiveau3'
        ));
    }
 
    
    public function getFilleuls(User $user)
    {
        $niveaux = [];
        
        // Niveau 1 : Filleuls directs
        $niveaux[1] = $user->filleuls;
    
        // Niveau 2 : Filleuls des filleuls directs
        $niveaux[2] = $user->filleuls()->with('filleuls')->get()->flatMap(function($filleul) {
            return $filleul->filleuls; // Récupérer les filleuls de chaque filleul direct
        });
    
        // Niveau 3 : Filleuls des filleuls de niveau 2
        $niveaux[3] = $niveaux[2]->flatMap(function($filleul) {
            return $filleul->filleuls; // Récupérer les filleuls de chaque filleul de niveau 2
        });
    
        // Récupérer le premier investissement pour chaque filleul
        foreach ($niveaux as &$niveau) {
            foreach ($niveau as $filleul) {
                // Récupérer la première occurrence dans la table pivot produit_user
                $firstProductEntry = ProduitUser::where('user_id', $filleul->id)
                    ->orderBy('created_at', 'asc')
                    ->first();
                    if ($firstProductEntry) {
                        // Récupérer le produit correspondant
                        $product = Produit::find($firstProductEntry->produit_id); // Assurez-vous que le modèle est correctement importé
                        
                        if ($product) {
                            $filleul->premier_investissement = $product->montant; // Montant du premier investissement
                            // dd($product->montant);
                            $filleul->date_de_creation_premier_investissement = $firstProductEntry->created_at; // Date de création du premier investissement
                        }
                        // dd($product);
                } else {
                    $filleul->premier_investissement = 0; // Montant si aucun investissement n'existe
                    $filleul->date_de_creation_premier_investissement = null; // Aucun investissement, donc date null
                }
            }
        }
    
        return $niveaux;
    }

    private function calculateTotalFirstInvestments($filleuls)
    {
        $totalFirstInvestments = 0;
    
        foreach ($filleuls as $filleul) {
            // Récupérer la première occurrence de l'utilisateur dans la table pivot produit_user
            $firstInvestmentEntry = ProduitUser::where('user_id', $filleul->id)
                ->orderBy('created_at', 'asc')
                ->first();
                if ($firstInvestmentEntry) {
                    // Récupérer le produit correspondant
                    $product = Produit::find($firstInvestmentEntry->produit_id); // Assurez-vous que le modèle est correctement importé
                    
                    if ($product) {
                        // dd($firstInvestmentEntry);
                        // Ajouter le montant du produit au total des premiers investissements
                        $totalFirstInvestments += $product->montant; // Si montant est dans produit_user
                    
                }
            }
        }
    
        return $totalFirstInvestments;
    }
}