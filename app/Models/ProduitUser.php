<?php

namespace App\Models;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitUser extends Model
{
    use HasFactory;
    protected $table ='produit_user';

    protected $fillable = ['produit_id', 'user_id', 'count', 'gagner', 'icon', 'last_checked'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    // public function calculateDailyRevenue()
    // {
    //     // Exemple : 5% de revenu par jour
    //     $dailyRate = $this->produit->gainJ; // Taux de revenu quotidien du produit
    //     $daysSincePurchase = now()->diffInDays($this->last_checked ?? $this->created_at);
    //     // dd($this);
    //     // dd(floor(-$daysSincePurchase));
    //     return  $dailyRate * floor(-$daysSincePurchase);
    // }
}
