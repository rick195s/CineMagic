<?php

namespace App\Models;

use Barryvdh\DomPDF\PDF;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $preco_bilhete_com_iva = number_format($conf->preco_bilhete_sem_iva * (1 + $conf->percentagem_iva / 100), 2);
        $this->preco_total_sem_iva = number_format($conf->preco_bilhete_sem_iva * $num_lugares, 2);
        $this->preco_total_com_iva = number_format($preco_bilhete_com_iva  * $num_lugares, 2);
        $this->iva = number_format($this->preco_total_com_iva - $this->preco_total_sem_iva, 2);
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

    /*
     * Criar pdf do recibo
     *
     * */
    public function criarPdf()
    {
        $data = [
            'user' => Auth::user(),
            'recibo' => $this,
            'bilhetes' => $this->bilhetes,
            'conf' => Configuracao::first(),
            'tipo_pagamento' => $this->tipo_pagamento,
            'ref_pagamento' => $this->ref_pagamento,
        ];

        $pdf = PDF::loadView('pdf.invoice', $data);

        $invoiceFileName =  uniqid(rand(), true) . '.pdf';

        Storage::put('pdf_recibos/' . $invoiceFileName, $pdf->output());
        $data['recibo']->recibo_pdf_url = $invoiceFileName;
        $data['recibo']->save();
    }
}
