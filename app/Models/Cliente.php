<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // relation clients 1:n bilhetes
    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }

    // relation clients 1:n recibos
    public function recibos()
    {
        return $this->hasMany(Recibo::class);
    }
}
