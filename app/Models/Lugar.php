<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;

    protected $table = 'lugares';

    // relation salas 1:n ligares
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
