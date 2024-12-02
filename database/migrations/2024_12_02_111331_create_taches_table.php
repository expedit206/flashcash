<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id(); // Création d'une colonne 'id' auto-incrémentée
            $table->string('description'); // Colonne pour la description
            $table->decimal('bonus', 10, 2); // Colonne pour le bonus
            $table->integer('cible'); // Colonne pour la cible
            $table->string('type'); // Colonne pour le type (standard ou special)
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
