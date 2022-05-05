<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    // relation salas 1:n sessoes
    public function sessoes()
    {
        return $this->hasMany(Sessao::class);
    }

    // relation salas 1:n lugares
    public function lugares()
    {
        return $this->hasMany(Lugar::class);
    }
}
