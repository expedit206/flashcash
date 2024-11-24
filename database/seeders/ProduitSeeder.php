<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produits')->insert([
            [
                'name' => 'Pack Énergie A',
                'montant' => 1000.00,
                'nbjour' => now()->addDays(30),
                'stock' => 'Disponible',
                'gainJ' => 20,
                'rendement' => 5,
            ],
            [
                'name' => 'Pack Énergie B',
                'montant' => 1500.00,
                'nbjour' => now()->addDays(45),
                'stock' => 'Disponible',
                'gainJ' => 30,
                'rendement' => 10,
            ],
            [
                'name' => 'Pack Énergie C',
                'montant' => 2000.00,
                'nbjour' => now()->addDays(60),
                'stock' => 'Épuisé',
                'gainJ' => 40,
                'rendement' => 15,
            ],
            [
                'name' => 'Pack Énergie D',
                'montant' => 2500.00,
                'nbjour' => now()->addDays(90),
                'stock' => 'Disponible',
                'gainJ' => 50,
                'rendement' => 20,
            ],
        ]);
    }
}
