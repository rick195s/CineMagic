<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    // $sessoes= [
    //               sessao_id => App\Models\Sessao,
    //               ...
    //               sessao_id_n => App\Models\Sessao,
    //           ]
    public $sessoes = [];

    // $lugares= [
    //     sessao_id => [
    //                      lugar_id => App\Models\Lugar,
    //                      ...
    //                      lugar_id_n => App\Models\Lugar,
    //                  ]
    public $lugares = [];


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

    public function adicionarLugar(Sessao $sessao, Lugar $lugar)
    {
        if (!isset($this->lugares[$sessao->id][$lugar->id])) {
            $this->lugares[$sessao->id][$lugar->id] = $lugar;
        }
        session()->put('carrinho', $this);
    }

    public function quantidade()
    {
        return count($this->sessoes);
    }

    public function todosLugaresAdicionados()
    {
        $todosLugares = [];
        foreach ($this->lugares as $lugares_sessao) {
            foreach ($lugares_sessao as $lugar) {
                $todosLugares[] = $lugar;
            }
        }
        return $todosLugares;
    }
}
