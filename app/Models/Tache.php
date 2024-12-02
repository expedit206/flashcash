<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    // app/Models/Tache.php

public function users()
{
    return $this->belongsToMany(User::class, 'tache_user');
}
}
