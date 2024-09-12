<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(30)->create();
        DB::table('users')->insert([
           [ 'name' => 'Expedit',
            'email' => 'expedit@gmail.com',
            'telephone' => 696428651,
            'email_verified_at' => now(),  // Timestamp actuel pour la vérification de l'email
            'password' => Hash::make('dominique2006'),  // Hachage du mot de passe
            'created_at' => now(),
            'updated_at' => now(),],
           [ 'name' => 'aaa',
            'email' => 'aaa@aaa',
            'telephone' => 600028651,
            'email_verified_at' => now(),  // Timestamp actuel pour la vérification de l'email
            'password' => Hash::make('aaaaaaaa'),  // Hachage du mot de passe
            'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}
