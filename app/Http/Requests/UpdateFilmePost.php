<?php

namespace App\Http\Requests;

use App\Models\Genero;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFilmePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("update", $this->route("filme"));
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo' => 'required|max:255',
            // o genero_code enviado pelo form tem de estar na tabela genero
            'genero_code' => ['required', 'max:20', Rule::in(Genero::all()->pluck('code')->toArray())],
            'ano' => 'required|numeric|min:1800|max:3000',
            'cartaz_url' => 'nullable|image|max:8192',
            'sumario' => 'required|max:500',
            'trailer_url' => 'required|url',
        ];
    }

    public function attributes()
    {
        return [
            'titulo' => __('Title'),
            'genero_code' => __('Movie Gender'),
            'ano' => __('Release Year'),
            'cartaz_url' => __('Movie Poster'),
            'sumario' => __('Summary'),
            'trailer_url' => __('Movie Trailer'),
        ];
    }
}
