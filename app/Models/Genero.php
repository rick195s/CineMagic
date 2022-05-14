<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genero extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = "code";

    // relation generos 1:n filmes
    public function filmes()
    {
        return $this->hasMany(Filme::class);
    }
}
