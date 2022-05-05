<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    // relation filmes 1:n sessoes
    public function sessoes()
    {
        return $this->hasMany(Sessao::class);
    }
}
