<?php
// app/Http/Controllers/ParrainageController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class ParrainageController extends Controller
{
    public function index()
     {
        // Récupérer l'utilisateur authentifié
        $user = auth()->user();

        // Calcul des revenus de commission
        $totalCommissions = Commission::where('user_id', $user->id)->sum('amount');
        // die;
        // Récupérer les filleuls de l'utilisateur (VIP 1)
        $vip1 = User::where('parrain_id', $user->id)->get();

        // Calculer le total des premiers dépôts de tous les filleuls (VIP 1)
        $totalFirstDepositsVip1 = $this->calculateTotalFirstDeposits($vip1);

        // Récupérer les filleuls des VIP 1 (VIP 2)
        $vip2 = User::whereIn('parrain_id', $vip1->pluck('id'))->get();

        // Calculer le total des premiers dépôts de tous les filleuls (VIP 2)
        $totalFirstDepositsVip2 = $this->calculateTotalFirstDeposits($vip2);

        // Récupérer les filleuls des VIP 2 (VIP 3)
        $vip3 = User::whereIn('parrain_id', $vip2->pluck('id'))->get();

        // Calculer le total des premiers dépôts de tous les filleuls (VIP 3)
        $totalFirstDepositsVip3 = $this->calculateTotalFirstDeposits($vip3);

        return view('parrainage.index', compact(
            'totalCommissions',
            'totalFirstDepositsVip1',
            'totalFirstDepositsVip2',
            'totalFirstDepositsVip3',
            'vip1',
            'vip2',
            'vip3',
            'user'
        ));
    }

    private function calculateTotalFirstDeposits($filleuls)
    {
        $totalFirstDeposits = 0;

        foreach ($filleuls as $filleul) {
            $firstDeposit = Deposit::where('user_id', $filleul->id)
                ->orderBy('created_at', 'asc')
                ->first();

            if ($firstDeposit) {
                $totalFirstDeposits += $firstDeposit->amount; // Ajouter le montant du premier dépôt
            }
        }

        return $totalFirstDeposits;
    }

    
    public function showFilleul()
    {
        $user = \Auth::user();
        $niveaux = $this->getFilleuls($user);
        return view('parrainage.filleuls', compact('niveaux'));
    }

    private function getFilleuls(User $user)
    {
        $niveaux = [];

        // Niveau 1 : Filleuls directs
        $niveaux[1] = $user->filleuls;
    
        // Niveau 2 : Filleuls des filleuls directs
        $niveaux[2] = $user->filleuls()->with('filleuls')->get()->flatMap(function($filleul) {
            return $filleul->filleuls; // Récupérer les filleuls de chaque filleul direct
        });
    
        // Niveau 3 : Filleuls des filleuls de niveau 2
        $niveaux[3] = $niveaux[2]->flatMap(function($filleul) {
            return $filleul->filleuls; // Récupérer les filleuls de chaque filleul de niveau 2
        });

        // dd($niveaux);
        return $niveaux;
    }
}