<?php

namespace App\Http\Requests;

use App\Models\Sessao;
use Illuminate\Foundation\Http\FormRequest;

class CreateSessaoPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Sessao::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filme_id' => 'required|exists:filmes,id',
            'sala_id' => 'required|exists:salas,id',
            'horario_inicio' => 'required|date_format:H:i:s',
            'data' => 'required|date_format:Y-m-d',
        ];
    }
}
