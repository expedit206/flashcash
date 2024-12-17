<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actionnaire extends Model
{

    protected $table = 'actionnaires'; // Nom de la table, si différent du nom du modèle

    protected $fillable = [
        'actionnaire_id',
        'telephone',
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'actionnaire_id');
    }
}
