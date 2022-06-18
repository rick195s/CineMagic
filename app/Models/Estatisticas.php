<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatisticas extends Model
{
    use HasFactory;

    public function getNumSales()
    {
        return number_format(Recibo::count(), 2, '.', ' ');
    }

    public function getNumTickets()
    {
        return number_format(Bilhete::count(), 0, '', ' ');
    }

    public function getNumUsers()
    {
        return number_format(User::count(), 0, '', ' ');
    }

    public function getValorVendas()
    {
        return number_format(Recibo::sum('preco_total_com_iva'), 2, ',', ' ');
    }

    public function getLastSales()
    {
        return Recibo::orderBy('data', 'desc')->take(10)->get();
    }
}
