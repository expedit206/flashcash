<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'used_count',
        'max_usage',
    ];

    // Définir la relation avec PromoCodeUsage
    public function usages()
    {
        return $this->hasMany(PromoCodeUsage::class);
    }
}