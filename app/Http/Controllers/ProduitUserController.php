<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\ProduitUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProduitUserController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
        
        // Récupérer les produits de l'utilisateur avec les données de la table pivot
        $produits = $user->produits()
        ->withPivot(['gagner', 'duration', 'count', 'last_incremented_at', 'created_at'])
        ->orderBy('produit_user.created_at', 'asc') // Utilisation du nom de la table pivot

        ->get();
        // dd(value)
        // dump($produits);
        // Calculer le revenu accumulé et le revenu d'aujourd'hui
        $totalRevenu = $produits->sum('pivot.gagner'); // Utiliser 'pivot' pour accéder aux colonnes de la table pivot
        $revenueToday = $produits->sum(function ($produit) {
            return $produit->gainJ; // Revenu quotidien du produit
        });

        // Calculer la durée restante pour chaque produit
        foreach ($produits as $produit) {
            $produit->remaining_duration = $this->calculateRemainingDuration($produit);
        }

        return view('produit_user.index', compact('produits', 'totalRevenu', 'revenueToday'));
    }

    /**
     * Calculer la durée restante en heures.
     */
    private function calculateRemainingDuration($produitUser)
{
    // Durée initiale en jours
    $initialDurationInDays = $produitUser->nbjour;

    // Convertir la durée initiale en heures
    $initialDurationInHours = $initialDurationInDays * 24;

    // Temps écoulé depuis la création
    $createdAt = Carbon::parse($produitUser->created_at);
    $now = Carbon::now();
// dump($produitUser->created_at);
    // Calculer la différence en heures et en jours
    $diffHours = $now->diffInHours($createdAt);
    $diffDays = $now->diffInDays($createdAt);

    // Total des heures écoulées
    $totalElapsedHours = ($diffDays * 24) + $diffHours;
// dd($diffHours);
    // Calculer la durée restante
    $remainingTimeInHours = $initialDurationInHours - $totalElapsedHours;

    // S'assurer que la durée restante ne soit pas négative
    return max(0, $remainingTimeInHours);
}
public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
    ]);

    // Récupération de l'utilisateur authentifié
    $user = Auth::user();

    // Récupérer le produit
    $produit = Produit::find($request->produit_id);

    // Vérifier la disponibilité du stock
    
    // Vérification si l'utilisateur a déjà acheté ce produit
    $produitUserExist = ProduitUser::where('user_id', $user->id)
    ->where('produit_id', $produit->id)
    ->latest('created_at') // Récupérer la dernière occurrence
    ->first();
    
    if ($produitUserExist && $produit->stock <= $produitUserExist->count) {
        return redirect()->route('produits.index')->with('error', 'Le produit est en rupture de stock.');
    }

    $produitUser = new ProduitUser();
        if ($produitUserExist) {
            // L'utilisateur a déjà acheté ce produit, on incrémente le compteur
            $produitUser->count =$produitUserExist->count +  1;
        } else {
        // L'utilisateur n'a pas encore acheté ce produit, on crée un nouvel enregistrement
        $produitUser->count = 1; // Initialiser à 1
    }
    $produitUser->user_id = $user->id;
    $produitUser->produit_id = $produit->id;
    $produitUser->gagner = 0; // Initialiser à zéro

    $produitUser->created_at = now(); // Date actuelle
    $produitUser->save(); // Enregistrement dans la base de données

    // Décrémenter le stock du produit
    $produit->save(); // Enregistrer la mise à jour du stock

    // Redirection avec un message de succès
    return redirect()->route('produits.index')->with('success', 'Produit acheté avec succès!');
}
}