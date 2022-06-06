<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    // O array de items é constituido da seguinte forma:
    // [
    //     sessao_id => [ 
    //                      "sessao" => App\Models\Sessao,
    //                       "lugares" => [
    //                                      lugar_id => App\Models\Lugar,
    //                                           ...   
    //                                       lugar_id_n => App\Models\Lugar,
    //                                      ]
    // ]
    public $items = [];


    public function adicionarSessao(Sessao $sessao)
    {
        // Uma sessao unica só é adicionada uma vez. Se o utilizador quiser 
        // comprar varios bilhetes de uma sessao, o que vai ter de fazer é 
        // selecionar varios lugares quando tiver no checkout
        if (!isset($this->items[$sessao->id])) {
            $this->items[$sessao->id]["sessao"] = $sessao;
        }
        session()->put('carrinho', $this);
    }

    public function adicionarLugar(Lugar $lugar, Sessao $sessao)
    {
        // 
        if (isset($this->items[$sessao->id]) && !isset($this->items[$sessao]["lugares"][$lugar->id])) {
            $this->items[$sessao->id]["lugares"][$lugar->id] = $lugar;
        }
        session()->put('carrinho', $this);
    }

    public function quantidade()
    {
        return count($this->items);
    }

    public function parseItems()
    {
        $sessoes = [];
        $lugares = [];
        foreach ($this->items as $conjunto_sessoes_lugares) {
            $sessoes[] = $conjunto_sessoes_lugares["sessao"] ?? null;
            foreach ($lugares_por_sessao["lugares"] ?? [] as $lugar) {
                $lugares[] = $lugar;
            }
        }

        return [$sessoes, $lugares];
    }
}
