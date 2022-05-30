<?php

namespace App\Http\Requests;

use App\Models\Sala;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $sala = Sala::find($this->route('sala'));

        return [
            'nome' => ['required', 'max:125', Rule::unique("salas")->ignore($sala->id ?? null)],
            'num_lugares' => 'required|numeric|min:1|max:500',
            'num_filas' => 'required|numeric|min:1|lte:num_lugares',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => __('Name'),
            'num_lugares' => __('Number of Seats'),
            'num_filas' => __('Number of Rows'),
        ];
    }
}
