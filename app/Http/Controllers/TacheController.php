<?php
namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\User; // Assurez-vous d'inclure le modèle User
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TacheController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Récupérer le nombre de filleuls directs qui ont acheté le pack bonus (produit_id = 1)
// Récupérer le nombre de filleuls directs qui ont acheté le pack bonus (produit_id = 1)
$nombreFilleulsBonus = $user->filleuls()->whereHas('produits', function($query) {
    $query->where('produit_id', 1); // Assurez-vous que c'est l'ID correct pour le pack bonus
})->count();

// Récupérer le nombre de filleuls directs qui ont acheté d'autres produits (tout autre produit que le pack bonus)
$nombreFilleulsStandard = $user->filleuls()->whereHas('produits', function($query) {
    $query->where('produit_id', '!=', 1); // Compter les filleuls qui ont autre chose que le pack bonus
})->count();

$taches = Tache::all();
        // Définir les tâches de parrainage
     
        // Préparer les données avec le nombre de parrainages
        foreach ($taches as &$tache) {
            // dd($tache['type']);
            if ($tache['type'] === 'special') {
                $tache['nombre_filleulSpecial'] = $nombreFilleulsBonus; // Nombre de filleuls parrainés pour le pack bonus
            } else {
                $tache['nombre_filleulStandard'] = $nombreFilleulsStandard; // Nombre de filleuls parrainés pour le pack standard
            }
            // dd($tache);
            
            // $tache['cible'] = $tache['cible']; // Cible de la tâche
        }
        $soldeTotal = $user->solde_total;

        return view('taches.index', compact('taches','soldeTotal'));
    }
}