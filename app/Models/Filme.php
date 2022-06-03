<?php

namespace App\Models;

use Carbon\Carbon;
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

    // buscar sessoes futuras
    public function sessoesFuturas()
    {
        return $this->sessoes()
            ->whereDate('data', '=', now()->format('Y-m-d'))
            ->whereTime('horario_inicio', '>=', now()->format('H:i:s'))
            ->orWhereDate('data', '>', now()->format('Y-m-d'))
            ->orderBy('data', 'asc')
            ->orderBy('horario_inicio', 'asc')
            ->take(5)
            ->get();
    }

    // buscar sessoes passadas
    public function sessoesPassadas()
    {
        return $this->sessoes()
            ->whereDate('data', '=', now()->format('Y-m-d'))
            ->whereTime('horario_inicio', '<', now()->format('H:i:s'))
            ->orWhereDate('data', '<', now()->format('Y-m-d'))
            ->orderBy('data', 'desc')
            ->orderBy('horario_inicio', 'desc')
            ->take(5)
            ->get();
    }
}
