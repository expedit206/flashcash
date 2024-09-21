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
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pack_id')->constrained()->onDelete('cascade');
            $table->integer('solde_actuel');
            $table->boolean('a_fait_retrait')->default(false);
            $table->integer('montant_retrait_total')->default(0);  // Le solde qui s'incrémente quotidiennement
            $table->integer('montant_retrait')->default(0);  // Le solde qui s'incrémente quotidiennement
            $table->timestamp('last_incremented_at')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'pack_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
