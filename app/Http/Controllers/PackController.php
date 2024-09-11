<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    // Afficher la liste des packs
    public function index()
    {
        $packs = Pack::orderBy('id','asc')->get();
        // dd($packs);

        return view('packs.index', compact('packs'));
    }

    // Afficher un pack spécifique
    public function show($id)
    {
        $pack = Pack::findOrFail($id);
        // dd($pack);
        return view('packs.show', compact('pack'));
    }

    // Gérer la souscription à un pack
    public function subscribe(Request $request, $id)
    {
        $user = $request->user();
        $pack = Pack::findOrFail($id);

        // Logique pour gérer la souscription
        $user->soldePrincipals()->create([
            'solde' => $pack->montant,
            'pack_id' => $pack->id,
        ]);

        return redirect()->route('packs.index')->with('success', 'Souscription réussie !');
    }
}
