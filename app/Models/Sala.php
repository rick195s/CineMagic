<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

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

    // saber sessoes futuras
    public function sessoes_futuras()
    {
        $now = Carbon::now();
        return $this->sessoes()
            ->where('data', '>=', $now->format('Y-m-d'))
            ->where('horario_inicio', '>=', $now->format('H:i:s'));
    }

    // saber quantas filas existem numa sala
    public function num_filas()
    {
        $filas = [];
        foreach ($this->lugares as $lugar) {
            if (!in_array($lugar->fila, $filas)) {
                array_push($filas, $lugar->fila);
            }
        }
        return count($filas);
    }

    // criar lugares numa sala
    public function criar_lugares($num_lugares, $num_filas)
    {
        $num_lugares_por_fila = ceil($num_lugares / $num_filas);

        $alphabet = range('A', 'Z');

        for ($i = 0; $i < $num_filas; $i++) {
            for ($j = 1; $j <= $num_lugares_por_fila && $j <= $num_lugares; $j++) {
                $this->lugares()->create([
                    'fila' => $alphabet[$i],
                    'posicao' => $j,
                ]);
            }
            $num_lugares -= $num_lugares_por_fila;
        };
    }

    // remover lugares numa sala
    public function remover_num_lugares($num)
    {
        $lugares = $this->lugares;
        $count = $lugares->count();
        for ($i = 0; $i < $num; $i++) {
            $lugares[$count - 1]->delete();
            $count--;
        }
    }

    // remover lugares permanentemente
    public function remover_permanentemente_lugares()
    {
        foreach ($this->lugares as $lugar) {
            $lugar->forceDelete();
        }
    }
}
