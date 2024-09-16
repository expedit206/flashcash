<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PackController extends Controller
{
    // Afficher la liste des packs
    public function index()
    {
        $packs = Pack::orderBy('id','asc')->get();
        // dd($packs);
$user=Auth::user();
        return view('packs.index', compact('packs','user'));
    }

    // Afficher un pack spécifique
    public function show($id)
    {
        $pack = Pack::findOrFail($id);
        // dd($pack);
        return view('packs.show', compact('pack'));
    }

    public function edit($id)
    {
        $pack = Pack::findOrFail($id);
        return view('packs.edit', compact('pack'));
    }

    // Mettre à jour le pack dans la base de données
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
        ]);

        $pack = Pack::findOrFail($id);
        $pack->name = $request->name;
        $pack->montant = $request->montant;

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
            $pack->icon = $iconPath;
        }

        $pack->save();

        return redirect()->route('packs.index')->with('success', 'Le pack a été mis à jour avec succès.');
    }
}
