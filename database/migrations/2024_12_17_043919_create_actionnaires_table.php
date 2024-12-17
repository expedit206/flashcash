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
        Schema::create('actionnaires', function (Blueprint $table) {  
            $table->id(); // Identifiant unique
            $table->foreignId('actionnaire_id')->constrained('users')->onDelete('cascade'); // Référence à l'utilisateur
            $table->string('telephone', 15); // Numéro de téléphone
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actionnaires');
    }
};
