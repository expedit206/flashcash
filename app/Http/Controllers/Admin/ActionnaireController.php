<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actionnaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionnaireController extends Controller
{
    public function index()
    {
        // Récupérer les actionnaires
        $actionnaires = Actionnaire::all(); // Récupérer tous les actionnaires
    
        // Récupérer les utilisateurs correspondants
        $userIds = $actionnaires->pluck('actionnaire_id'); // Extraire les ID des utilisateurs
    
        // Récupérer les utilisateurs qui ont ces IDs et compter les filleuls
        $users = User::whereIn('id', $userIds)->withCount('filleuls')->get();
    
        // Filtrer ceux qui ont plus de 6 filleuls
        $actionnaires = $users->filter(function ($user) {
            return $user->filleuls_count > 8; // Garder uniquement ceux avec plus de 6 filleuls
        });
    
        return view('admin.actionnaires.index', compact('actionnaires'));
    }


    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'actionnaire_id' => 'required|exists:users,id',
            'telephone' => 'required|string|max:15',
        ]);
    
        // Enregistrement du numéro de téléphone dans la table shareholders
        Actionnaire::create([
            'actionnaire_id' => $request->actionnaire_id,
            'telephone' => $request->telephone,
        ]);
    
        // Redirection avec message de succès
        return redirect()->route('produits.index')->with('success', 'Numéro récupéré avec succès ! Nous vous contacterons dans un futur proche');
    }

    public function create(Request $request)
    {
     $user  = Auth::user();
        return view('admin.actionnaires.form', compact('user'));
    }
    
    // Méthode store et autres restent inchangées
}   