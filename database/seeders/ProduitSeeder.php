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
        DB::table('packs')->insert([
            [
                'name' => 'Junior',
                'icon' => 'fa-compass',
                'montant' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elite',
                'icon' => 'fa-rocket',
                'montant' => 5000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Champion',
                'icon' => 'fa-crown',
                'montant' => 10000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Visionary',
                'icon' => 'fa-medal',
                'montant' => 15000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Legendary',
                'icon' => 'fa-trophy',
                'montant' => 30000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ultimate',
                'icon' => 'fa-star',
                'montant' => 500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
