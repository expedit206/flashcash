<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TacheUserController extends Controller
{
    public function recuperer(Tache $tache)
    {
        $user = Auth::user(); // Récupérer l'utilisateur authentifié
        // Récupérer la tâche par ID

        // Vérifier si l'utilisateur a déjà récupéré la tâche
        if ($user->taches()->where('tache_id', $tache->id)->exists()) {
            return redirect()->back()->with('error', 'Vous avez déjà récupéré ce bonus.');
        }

        // Enregistrer l'association dans la table tache_user
        $user->taches()->attach($tache->id);
        $user->solde_total += $tache->bonus;
        $user->save();
        return redirect()->back()->with('success', 'Bonus récupéré avec succès !');
    }
}
