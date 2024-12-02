<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TacheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taches = [
            ['description' => 'Parrainer 3 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 1500, 'cible' => 3, 'type'=> 'standard'],
            ['description' => 'Parrainer 10 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 3000, 'cible' => 10, 'type'=> 'standard'],
            ['description' => 'Parrainer 25 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 10000, 'cible' => 20, 'type'=> 'standard'],
            ['description' => 'Parrainer 45 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 15000, 'cible' => 30, 'type'=> 'standard'],
            ['description' => 'Parrainer 60 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 25000, 'cible' => 50, 'type'=> 'standard'],
            ['description' => 'Parrainer 80 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 40000, 'cible' => 75, 'type'=> 'standard'],
            ['description' => 'Parrainer 120 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 60000, 'cible' => 100, 'type'=> 'standard'],
            ['description' => 'Parrainer 155 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 80000, 'cible' => 125, 'type'=> 'standard'],
            ['description' => 'Parrainer 175 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 100000, 'cible' => 150, 'type'=> 'standard'],
            ['description' => 'Parrainer 200 personnes qui achètent le produit T-Cash (de 1 à 10)', 'bonus' => 120000, 'cible' => 200, 'type'=> 'standard'],
            ['description' => 'Parrainer 5 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 1500, 'cible' => 5, 'type'=> 'special'],
            ['description' => 'Parrainer 15 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 3000, 'cible' => 15, 'type'=> 'special'],
            ['description' => 'Parrainer 35 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 10000, 'cible' => 35, 'type'=> 'special'],
            ['description' => 'Parrainer 50 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 15000, 'cible' => 50, 'type'=> 'special'],
            ['description' => 'Parrainer 75 personnes qui achètent le produit T-Cash Bonus', 'bonus' => 25000, 'cible' => 75, 'type'=> 'special'],
        ];

        \DB::table('taches')->insert($taches);
        }
}
