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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur
            $table->decimal('amount', 10, 2); // Montant de la transaction
            $table->string('type'); // 'deposit' ou 'withdrawal'
            $table->string('status'); // 'success' ou 'failed'
            $table->string('transaction_id')->nullable(); // ID de la transaction de Mesomb
            $table->string('payment_method'); // Méthode de paiement
            $table->timestamps(); // Dates de création et mise à jour
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
