<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'cliente_id',
        'data',
        'preco_total_sem_iva',
        'iva',
        'preco_total_com_iva',
        'nif',
        'nome_cliente',
        'tipo_pagamento',
        'ref_pagamento',
        'recibo_pdf_url',
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

    public function __construct($nif = null, $tipo_pagamento = null, $ref_pagamento = null, $num_lugares = null)
    {
        $conf = Configuracao::first();

        $preco_bilhete_com_iva = $conf->preco_bilhete_sem_iva * (1 + $conf->percentagem_iva / 100);
        $this->preco_total_sem_iva = $conf->preco_bilhete_sem_iva * $num_lugares;
        $this->preco_total_com_iva = $preco_bilhete_com_iva  * $num_lugares;
        $this->iva = $this->preco_total_com_iva - $this->preco_total_sem_iva;
        $this->cliente_id = auth()->user()->cliente->id;
        $this->nome_cliente = auth()->user()->name;
        $this->nif = $nif;
        $this->tipo_pagamento = $tipo_pagamento;
        $this->ref_pagamento = $ref_pagamento;
        $this->data = now()->format('Y-m-d');
    }

    // relation clients 1:n recibos
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // relation recibos 1:n bilhetes
    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }
}
