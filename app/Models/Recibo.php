<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    // relation clients 1:n recibos
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // relation recibos 1:n bilhetes
    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }
}
