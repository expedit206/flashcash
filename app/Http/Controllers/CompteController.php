<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pack;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function create()
{
    $users = User::all();  // Récupérer tous les utilisateurs avec leurs téléphones
    $packs = Pack::all();  // Récupérer tous les packs

    return view('admin.add_compte', compact('users', 'packs'));
}

public function store(Request $request)
{
    // Validation des données entrantes
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'pack_id' => 'required|exists:packs,id',
    ]);

    $exists = \DB::table('comptes')
    ->where('user_id', $request->user_id)
    ->where('pack_id', $request->pack_id)
    ->exists();

if ($exists) {
    return redirect()->back()->withError('Cette combinaison de utilisateur et pack existe déjà.');
}
    // Création du compte avec les données soumises
    \DB::table('comptes')->insert([
        'user_id' => $request->user_id,
        'pack_id' => $request->pack_id,
        'solde_actuel' => 0,
        'a_fait_retrait' => false,
        'montant_retrait_total' => 0,
        'montant_retrait' => 0,
        'last_incremented_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Compte créé avec succès.');
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

    public function subscribe(Request $request, )
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
        'montant' => 'required|numeric|min:3000',
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

    $compte->montant_retrait = $montant;
    $compte->montant_retrait_total += $montant;
    $compte->save();

    // Marquer que le retrait a été effectué
    $compte->update(['a_fait_retrait' => true]);

    return redirect()->route('comptes.show', ['user' => $userId, 'pack' => $compte->pack_id])
                     ->with('success', 'Retrait effectué avec succès. Vous recevrez vos frais dans les cinq prochaines heures.');
}
public function destroy($id)
{
    // Validation pour vérifier si le compte existe
    $compte = DB::table('comptes')->find($id);

    if (!$compte) {
        return redirect()->back()->with('error','Compte non trouvé.');
    }

    // Suppression du compte
    DB::table('comptes')->where('id', $id)->delete();

    // Redirection avec message de succès
    return redirect()->route('admin.all_comptes')->with('success', 'Compte supprimé avec succès.');
}


public function actualiser($userId, $compteId)
{
    // Récupérer l'utilisateur et le pack concernés
    $user = DB::table('users')->find($userId);
    $compte = DB::table('comptes')->find($compteId);
    $pack = Pack::whereRelation('comptes', 'id', $compteId)->first();
// dd($pack);
    if (!$user || !$compte) {
        return redirect()->back()->withErrors('Utilisateur ou compte non trouvé.');
    }

    $now = Carbon::now();

    $lastUpdate = Carbon::parse($compte->last_incremented_at);
    $diffInHours = $now->diffInHours($lastUpdate);
    $diffInHours = $now->diffInHours($lastUpdate);
    // Si au moins un jour est passé, on incrémente le solde
    /* `dd();` is a debugging function in Laravel that stands for "Dump and Die". It is
    used to dump the variable or expression passed to it and then immediately stop the script
    execution. */
    // dd($diffInHours);
        if ($diffInHours >= 1) {
        $montantIncremente = $pack->montant * 0.10; // 15% du montant du compte
        $soldeActuel = DB::table('comptes')->where('user_id', $user->id)->where('id', $compte->id)->value('solde_actuel');
        // die;

        // Mise à jour du solde actuel dans la table comptes
        Compte::where('id', $compte->id)->where('user_id', $user->id)->update([
            'solde_actuel' => $soldeActuel + $montantIncremente,
        ]);

        // Mettre à jour la date de la dernière actualisation de l'utilisateur
        DB::table('comptes')->where('user_id', $user->id)->update([
            'last_incremented_at' => $now,
        ]);

        return redirect()->back()->with('success', 'Le solde a été actualisé avec succès.');
    } else {
        $remainingTime = $lastUpdate->addDay()->diffForHumans($now, true); // Temps restant avant la prochaine actualisation
        return redirect()->back()->withError("Veuillez attendre encore $remainingTime avant de pouvoir actualiser.");
    }
}
}
