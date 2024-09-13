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

}
