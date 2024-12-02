<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CompteSeeder;
use Database\Seeders\EpargneSeeder;
use Database\Seeders\ProduitSeeder;
use Database\Seeders\ProduitUserSeeder;
use Database\Seeders\TacheSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

   
        $this->call([
            ProduitSeeder::class,
            UserSeeder::class,
            ProduitUserSeeder::class,
            EpargneSeeder::class,
            TacheSeeder::class,
            // CompteSeeder::class,
        ]);
    }
}
