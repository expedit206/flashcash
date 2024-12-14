<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProduitUser;
use Illuminate\Http\Request;

class ProduitUserController extends Controller
{
    // Afficher la liste des produits
    public function index()
    {
        $produitUsers = ProduitUser::all();
        return view('admin.produit_user.index', compact('produitUsers'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('admin.produit_user.create');
    }

    // Stocker un nouveau produit
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produit_id' => 'required|exists:produits,id',
            'gagner' => 'integer',
            'duration' => 'nullable|date',
            'count' => 'integer',
            'last_incremented_at' => 'nullable|date',
        ]);

        ProduitUser::create($request->all());
        return redirect()->route('produit_user.index')->with('success', 'Produit ajouté avec succès.');
    }

    // Afficher un produit spécifique
    public function show(ProduitUser $produitUser)
    {
        return view('admin.produit_user.show', compact('produitUser'));
    }

    // Afficher le formulaire d'édition
    public function edit(ProduitUser $produitUser)
    {
        return view('admin.produit_user.edit', compact('produitUser'));
    }

    // Mettre à jour un produit
    public function update(Request $request, ProduitUser $produitUser)
    {
        $request->validate([
            'gagner' => 'integer',
            'duration' => 'nullable|date',
            'count' => 'integer',
            'last_incremented_at' => 'nullable|date',
        ]);

        $produitUser->update($request->all());
        return redirect()->route('produit_user.index')->with('success', 'Produit mis à jour avec succès.');
    }

    // Supprimer un produit
    public function destroy(ProduitUser $produitUser)
    {
        $produitUser->delete();
        return redirect()->route('produit_user.index')->with('success', 'Produit supprimé avec succès.');
    }
}