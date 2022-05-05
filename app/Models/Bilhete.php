<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilhete extends Model
{
    use HasFactory;

    // relation sessoes 1:n bilhetes
    public function sessao()
    {
        return $this->belongsTo(Sessao::class);
    }
}
