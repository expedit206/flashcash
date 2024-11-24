<?php

namespace App\Models;

use App\Models\Compte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'montant', 'benefice','icon'];

    public function comptes()
    {
        return $this->hasMany(Compte::class);
    }
    public function users()
    {
        return $this->belongsTomany(User::class);
    }

}
