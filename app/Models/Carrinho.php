<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    public $items = [];

    public function __construct(Carrinho $carrinho = null)
    {
        if ($carrinho) {
            $this->items = $carrinho->items;
        }
    }

    public function adicionar(Sessao $sessao)
    {
        // Uma sessao unica só é adicionada uma vez. Se o utilizador quiser 
        // comprar varios bilhetes de uma sessao, o que vai ter de fazer é 
        // selecionar varios lugares quando tiver no checkout
        if (!isset($this->items[$sessao->id])) {
            $this->items[$sessao->id] = $sessao;
        }
        session()->put('carrinho', $this);
    }

    public function quantidade()
    {
        return count($this->items);
    }
}
