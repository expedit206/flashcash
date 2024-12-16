<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCodeUser extends Model
{
    use HasFactory;

    protected $table ='promo_code_user';
    protected $fillable = [
        'user_id',
        'promo_code_id',
        'status'
    ];

    // Définir la relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Définir la relation avec PromoCode
    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }
}