<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Assurez-vous d'importer le modèle User
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Affiche la liste des utilisateurs
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get(); // Récupère tous les utilisateurs triés par ID décroissant

        foreach ($users as $user) {
            // Vérifie si l'utilisateur a un parrain
            if ($user->parrain_id) {
                // Récupère le nom du parrain
                $user->parrainName = User::find($user->parrain_id)->name;
                
                // Compte le nombre de filleuls
                $user->nombreFilleuls = User::where('parrain_id', $user->id)->count();
            } else {
                $user->parrainName = null; // Aucun parrain
                $user->nombreFilleuls = 0; // Aucun filleul
            }
            
            // dump($user); // Pour déboguer si nécessaire
        }
        return view('admin.users.index', compact('users')); // Affiche la vue avec les utilisateurs
    }

    // Affiche le formulaire de création d'un nouvel utilisateur
    public function create()
    {
        return view('admin.users.create'); // Retourne le formulaire de création
    }

    // Stocke un nouvel utilisateur dans la base de données
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Crée l'utilisateur
        $validatedData['password'] = bcrypt($validatedData['password']); // Hash le mot de passe
        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès');
    }

    // Affiche le formulaire d'édition d'un utilisateur
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user')); // Retourne le formulaire d'édition
    }

    // Met à jour les informations d'un utilisateur
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'telephone' => 'required|integer|unique:users,telephone,' . $user->id,
            'password' => 'nullable|confirmed',
            'solde_total' => 'required|numeric',
            'depot_total' => 'required|numeric',
            'retrait_total' => 'required|numeric',
            'parrain_id' => 'nullable|exists:users,id', // Vérifie que l'ID existe dans la table users
            'password_transaction' => 'nullable|min:6',
        ]);
    
        // Si un nouveau mot de passe est fourni, hash le mot de passe
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']); // Retire le mot de passe si vide
        }
    
        // Met à jour les informations de l'utilisateur
        $user->update($validatedData);
    // dump($user);
    // dd($validatedData);
        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès');
    }
    // Supprime un utilisateur de la base de données
    public function destroy(User $user)
    {
        $user->delete(); // Supprime l'utilisateur
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}