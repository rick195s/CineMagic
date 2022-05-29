<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'nome',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
    ];

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

    // saber quantas filas existem numa sala
    public function number_of_rows()
    {
        $num_filas = 0;
        $lugares = $this->lugares;
        $alphabet = range('A', 'Z');

        for ($i = 0; $i < count($alphabet); $i++) {
            foreach ($lugares as $lugar) {
                if ($lugar->fila == $alphabet[$i]) {
                    $num_filas++;
                    break;
                }
            }
        }
        return $num_filas;
    }

    // criar lugares numa sala
    public function create_seats(Sala $sala, $num_lugares, $num_filas)
    {
        $num_lugares_por_fila = ceil($num_lugares / $num_filas);

        $alphabet = range('A', 'Z');

        for ($i = 0; $i < $num_filas; $i++) {
            for ($j = 1; $j <= $num_lugares_por_fila && $j <= $num_lugares; $j++) {
                $sala->lugares()->create([
                    'fila' => $alphabet[$i],
                    'posicao' => $j,
                ]);
            }
            $num_lugares -= $num_lugares_por_fila;
        };
    }

    // remover lugares numa sala
    public function remove_num_seats($num)
    {
        $lugares = $this->lugares;
        $count = $lugares->count();
        for ($i = 0; $i < $num; $i++) {
            $lugares[$count - 1]->delete();
            $count--;
        }
    }

    // remover lugares permanentemente
    public function permanent_remove_seats()
    {
        foreach ($this->lugares as $lugar) {
            $lugar->forceDelete();
        }
    }
}
