<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSalaPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("create", Sala::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:125|unique:salas',
            'num_lugares' => 'required|numeric|min:1|max:500',
            // 'num_lugares_por_fila'
        ];
    }

    public function attributes()
    {
        return [
            'nome' => __('Name'),
            'num_lugares' => __('Number of Seats'),
        ];
    }
}
