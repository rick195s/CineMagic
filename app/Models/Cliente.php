<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Cliente extends User
{
    use HasFactory;

    // relation clients 1:n bilhetes
    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }
}
