<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'filme_id',
        'sala_id',
        'data',
        'horario_inicio',
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

    protected $table = 'sessoes';

    // relation salas 1:n sessoes
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    // relation filmes 1:n sessoes
    public function filme()
    {
        return $this->belongsTo(Filme::class);
    }

    // relation sessoes 1:n bilhetes
    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }

    // verificar se um lugar está ocupado
    public function ocupado($lugar_id)
    {
        foreach ($this->bilhetes as $bilhete) {
            if ($bilhete->lugar_id == $lugar_id) {
                return true;
            }
        }

        return false;
    }

    // saber quais as salas usadas num conjunto de sessoes
    // (funcao utilizada para diminuir o numero de vezes que sao feitas
    // querys à base de dados)
    public static function salasDasSessoes($conj_sessoes)
    {
        // saber quais salas é que são precisas
        $id_salas = [];
        foreach ($conj_sessoes as $sessoes) {
            foreach ($sessoes as $sessao) {
                $id_salas[] = $sessao->sala_id;
            }
        }
        $id_salas = array_unique($id_salas);

        // obter as salas
        $salas = Sala::whereIn('id', $id_salas)->get();

        // organizar as salas por id de sala
        $salas_por_id = [];
        foreach ($salas as $sala) {
            $salas_por_id[$sala->id] = $sala;
        }
        return $salas_por_id;
    }
}
