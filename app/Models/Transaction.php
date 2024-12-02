<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',           // Lien avec l'utilisateur
        'amount',            // Montant de la transaction
        'type',              // 'deposit' ou 'withdrawal'
        'status',            // 'success' ou 'failed'
        'transaction_id',    // ID de la transaction de Mesomb
        'payment_method',     // Méthode de paiement
    ];
}