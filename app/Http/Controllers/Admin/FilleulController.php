<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class FilleulController extends Controller
{
    public function show($id)
    {
        // Récupère l'utilisateur
        $user = User::find($id);

        // Récupère les filleuls de cet utilisateur
        $filleuls = User::where('parrain_id', $user->id)->get();

        foreach ($filleuls as $filleul) {
            // Vérifie si l'utilisateur a un parrain
            if ($filleul->parrain_id) {
                // Récupère le nom du parrain
                $filleul->parrainName = User::find($filleul->parrain_id)->name;
                
                // Compte le nombre de filleuls
                $filleul->nombreFilleuls = User::where('parrain_id', $filleul->id)->count();
            } else {
                $filleul->parrainName = null; // Aucun parrain
                $filleul->nombreFilleuls = 0; // Aucun filleul
            }
            
            // dump($user); // Pour déboguer si nécessaire
        }
        // Retourne la vue avec les filleuls
        return view('admin.filleuls.index', compact('user', 'filleuls'));
    }
}
