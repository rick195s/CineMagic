<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $primaryKey = "code";

    // relation generos 1:n filmes
    public function filmes()
    {
        return $this->hasMany(Filme::class);
    }
}
