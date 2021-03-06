<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'nif',
        'endereco',
        'tipo_pagamento',
        'ref_pagamento'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    // relation clients 1:n bilhetes
    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }

    // relation clients 1:n recibos
    public function recibos()
    {
        return $this->hasMany(Recibo::class);
    }

    // relation clientes 1:1 users
    // the client have properties that are inside "users" table, so
    // we need to use the "user" relationship to get the properties
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
