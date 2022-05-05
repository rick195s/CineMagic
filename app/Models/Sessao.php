<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    // relation salas 1:n sessoes
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
