<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // N'oubliez pas d'importer Carbon

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->setTimezone('Africa/Douala'); // Obtenir la date et l'heure actuelles

        DB::table('produits')->insert([
            [
                'name' => 'T-Cash Bonus',
                'montant' => 2500.00,
                'nbjour' => 20,
                'stock' => 1,
                'status'=> 'disponible',
                'gainJ' => 250.00,
                'img'=>'/img/FC3.jpg',
                'rendement' => 10,
                'created_at' => $now, // Ajouter la date de création
                'updated_at' => $now, // Ajouter la date de mise à jour
            ],
            [
                'name' => 'T-Cash 1',
                'montant' => 5000.00,
                'nbjour' => 37,
                'stock' => 10,
                'status'=> 'disponible',
                'gainJ' => 270.00,
                'img'=>'/img/FC1.jpg',
                'rendement' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 2',
                'montant' => 12000.00,
                'nbjour' => 38,
                'stock' => 8,  // Épuisé
                'status'=> 'disponible',
                'gainJ' => 650.00,
                'img'=>'/img/FC4.webp',
                'rendement' => 6.2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 3',
                'montant' => 25000.00,
                'nbjour' => 36,
                'stock' => 8,
                'status'=> 'disponible',
                'gainJ' => 1450.00,
                'img'=>'/img/FC5.jpg',
                'rendement' => 6.4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 4',
                'montant' => 48000.00,
                'nbjour' => 34,
                'stock' => 7,
                'status'=> 'disponible',
                'gainJ' => 3000.00,
                'img'=>'/img/FC6.jpg',
                'rendement' => 6.5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 5',
                'montant' => 87000.00,
                'nbjour' => 30,
                'stock' => 5,
                'status'=> 'disponible',
                'gainJ' => 6100.00,
                'img'=>'/img/FC7.jpg',
                'rendement' => 7.01,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 6',
                'montant' => 180000.00,
                'nbjour' => 30,
                'stock' => 5,
                'status'=> 'disponible',
                'gainJ' => 12700.00,
                'img'=>'/img/FC8.jpg',
                'rendement' => 7.15,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 7',
                'montant' => 260000.00,
                'nbjour' => 30,
                'stock' => 6,
                'status'=> 'disponible',
                'gainJ' => 18400.00,
                'img'=>'/img/FC9.jpg',
                'rendement' => 7.37,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 8',
                'montant' => 350000.00,
                'nbjour' => 30,
                'stock' => 7,
                'status'=> 'disponible',
                'gainJ' => 25950.00,
                'img'=>'/img/FC10.jpg',
                'rendement' => 7.4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 9',
                'montant' => 700000.00,
                'nbjour' => 30,
                'stock' => 5,
                'status'=> 'disponible',
                'gainJ' => 49930.00,
                'img'=>'/img/FC4.webp',
                'rendement' => 7.73,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'T-Cash 9',
                'montant' => 1400000.00,
                'nbjour' => 30,
                'stock' => 3,
                'status'=> 'disponible',
                'gainJ' => 49930.00,
                'img'=>'/img/FC4.webp',
                'rendement' => 8.13,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}