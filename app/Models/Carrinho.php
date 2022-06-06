<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    public $sessoes = [];
    public $bilhetes = [];

    public function adicionarSessao(Sessao $sessao)
    {
        // Uma sessao unica só é adicionada uma vez. Se o utilizador quiser 
        // comprar varios bilhetes de uma sessao, o que vai ter de fazer é 
        // selecionar varios lugares quando tiver no checkout
        if (!isset($this->sessoes[$sessao->id])) {
            $this->sessoes[$sessao->id] = $sessao;
        }
        session()->put('carrinho', $this);
    }

    public function adicionarBilhete(Bilhete $bilhete)
    {
        if (!isset($this->bilhetes[$bilhete->id])) {
            $this->bilhetes[$bilhete->id] = $bilhete;
        }
        session()->put('carrinho', $this);
    }

    public function quantidade()
    {
        return count($this->sessoes) + count($this->bilhetes);
    }

    public function sessoes()
    {
        return $this->sessoes;
    }

    public function bilhetes()
    {
        return $this->bilhetes;
    }
}
