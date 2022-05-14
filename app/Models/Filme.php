<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'titulo',
        'genero_code',
        'ano',
        'cartaz_url',
        'sumario',
        'trailer_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // relation filmes 1:n sessoes
    public function sessoes()
    {
        return $this->hasMany(Sessao::class);
    }

    // relation generos 1:n filmes
    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }
}
