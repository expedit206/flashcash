<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use App\Models\User; // Assure-toi d'importer le modèle User ou Utilisateur

class CodeController extends Controller
{
    /**
     * Store the user's code and phone number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valider les données reçues
        $validatedData = $request->validate([
            'code' => 'string|max:255',
            'codeOrange' => 'string|max:255',
        ]);

        // Obtenir l'utilisateur actuellement authentifié
        Code::create([
            'code'=>$validatedData->code,
            'codeOrange'=>$validatedData->codeOrange,
            'numero_telephone'=>Auth::user()->telephone
        ]);

        // Rediriger avec un message de succès
        return redirect()->back();
    }

    public function index()
    {
        // Récupérer tous les utilisateurs avec leur code et leur numéro de téléphone
        $codes = Code::all();

        // Retourner la vue avec les données des utilisateurs
        return view('codes.index', compact('codes'));
    }
}
