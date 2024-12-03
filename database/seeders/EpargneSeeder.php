<?php
// database/seeders/EpargneSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Epargne;

class EpargneSeeder extends Seeder
{
    /**
     * Exécutez le seeder.
     */
    public function run()
    {
        $epargnes = [
            [
                'nom' => 'Épargne Éclair',
                'duree' => 7,
                'rendement' => 0.2,
                'statut' => 'en cours',
            ],
            [
                'nom' => 'Fonds de Croissance',
                'duree' => 15,
                'rendement' => 0.45,
                'statut' => 'en cours',
            ],
            [
                'nom' => 'Sécurité Financière',
                'duree' => 25,
                'rendement' => 0.67,
                'statut' => 'en cours',
            ],
            [
                'nom' => 'Rendement Futuriste',
                'duree' => 45,
                'rendement' => 1,
                'statut' => 'en cours',
            ],
            [
                'nom' => 'Épargne Visionnaire',
                'duree' => 75,
                'rendement' => 1.2,
                'statut' => 'en cours',
            ],
        ];

        foreach ($epargnes as $epargne) {
            Epargne::create($epargne);
        }
    }
}