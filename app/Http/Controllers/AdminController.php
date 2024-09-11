<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function listUsers()
{
    $users = User::all();
    return view('admin.users', compact('users'));
}


public function viewUserComptes($userId)
{
    $user = User::with('comptes')->findOrFail($userId);
    $totalRetrait = $user->comptes->sum('montant_retrait_total');
    return view('admin.user_comptes', compact('user', 'totalRetrait'));
}

public function editCompte($compteId)
{
    $compte = Compte::findOrFail($compteId);
    return view('admin.edit_compte', compact('compte'));
}

public function updateCompte(Request $request, $compteId)
{
    $request->validate([
        'solde_actuel' => 'required|numeric|min:0',
    ]);

    $compte = Compte::findOrFail($compteId);
    $compte->update($request->all());

    return redirect()->route('admin.user.comptes', $compte->user_id)
                     ->with('success', 'Compte mis à jour avec succès.');
}

public function deleteCompte($compteId)
{
    $compte = Compte::findOrFail($compteId);
    $compte->delete();

    return redirect()->back()->with('success', 'Compte supprimé avec succès.');
}

public function totalRetraits()
{
    $totalRetraitGlobal = Compte::sum('montant_retrait_total');
    return view('admin.total_retraits', compact('totalRetraitGlobal'));
}

public function comptesParPack()
{
    $packs = Pack::withCount('comptes')->get();
    return view('admin.comptes_par_pack', compact('packs'));
}


}
