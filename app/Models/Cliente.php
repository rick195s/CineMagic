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

    // relation clientes 1:1 users
    // the client have properties that are inside "users" table, so
    // we need to use the "user" relationship to get the properties
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
