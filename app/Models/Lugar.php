<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lugar extends Model
{
    use HasFactory, SoftDeletes;

    protected $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'sala_id',
        'fila',
        'posicao',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
    ];


    protected $table = 'lugares';

    // relation salas 1:n ligares
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    // relation bilhetes 1:1 lugares
    public function bilhete()
    {
        return $this->hasOne(Bilhete::class);
    }
}
