<?php

namespace App\Models;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Bilhete extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'sessao_id',
        'recibo_id',
        'lugar_id',
        'cliente_id',
        'preco_sem_iva',
        'estado'
    ];

    // relation sessoes 1:n bilhetes
    public function sessao()
    {
        return $this->belongsTo(Sessao::class);
    }

    // relation bilhetes n:1 lugares
    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }

    // relation clients 1:n bilhetes
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // relation recibos 1:n bilhetes
    public function recibo()
    {
        return $this->belongsTo(Recibo::class);
    }

    // verificar se o bilhete ja foi usado
    public function usado()
    {
        return $this->estado == 'usado';
    }

    /**
     * Criar um pdf do bilhete
     */
    public function criarPdf()
    {
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->generate(route('admin.bilhetes.use', $this->id)));

        $pdf = PDF::loadView('pdf.ticket', [
            "user" => Auth::user(),
            "bilhete" => $this,
            "qrcode" => $qrcode
        ]);

        return $pdf;
    }
}
