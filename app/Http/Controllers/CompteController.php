<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $comptes = Compte::where('user_id', $user->id)->get();
        return view('comptes.index', compact('comptes'));
    }

    public function show(User $user,Pack $pack)
    {
        
        // Trouver le pack par ID
        $pack = Pack::findOrFail($pack->id);
        // Trouver l'utilisateur par ID
        $user = User::findOrFail($user->id);

        // Trouver le compte de l'utilisateur (vous devrez ajuster cela en fonction de votre relation)
        $compte = Compte::where('user_id', $user->id)
        ->where('pack_id', $pack->id)
        ->first(); // Si le compte n'est pas trouvé, une erreur 404 sera lancée

return view('comptes.show', compact('pack', 'compte'));// Adaptez si nécessaire

    }

    public function subscribe(Request $request, Pack $pack)
    {
        return view("packs.subscribe");
    }

    public function showRetrait($id)
    {
        $item = User::findOrFail($id);
        return view('comptes.showRetrait', compact('item'));
    }
// app/Http/Controllers/RetraitController.php
public function storeRetrait(Request $request, $userId, $compteId)
{
    $compte = Compte::findOrFail($compteId);
    $user = User::findOrFail($userId);

    // Validation du montant
    $request->validate([
        'montant' => 'required|numeric|min:1',
    ]);

    $montant = $request->input('montant');

    // Vérifiez si le montant est disponible
    if ($compte->solde_actuel < $montant) {
        return redirect()->route('comptes.show', ['user' => $userId, 'pack' => $compte->pack_id])
                         ->with('error', 'Montant insuffisant pour le retrait.');
    }
    if ( $compte->a_fait_retrait =='true') {
        return redirect()->route('comptes.show', ['user' => $userId, 'pack' => $compte->pack_id])
                         ->with('error', 'Veuillez attendre l\'arrive du retrait precedent!!!');
    }

    // Effectuer le retrait
    $compte->solde_actuel -= $montant;

    $compte->montant_retrait_total += $montant;
    $compte->save();

    // Marquer que le retrait a été effectué
    $compte->update(['a_fait_retrait' => true]);

    return redirect()->route('comptes.show', ['user' => $userId, 'pack' => $compte->pack_id])
                     ->with('success', 'Retrait effectué avec succès. Vous recevrez vos frais dans les cinq prochaines heures.');
}
}
