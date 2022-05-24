<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $user = null;

    public function authorize()
    {
        $this->user = User::findOrFail($this->route('user'));
        return $this->user()->can('update', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => ['string', 'max:255'],
            // ignore serve para nao verificarmos se o email inserido é igual ao email do utilizador que estamos a editar
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id),],
            'tipo' => [Rule::in(['A', 'F'])],
            'bloqueado' => ['boolean'],
            'foto_url' => ['nullable', 'image', 'max:8192'],

        ];
    }
}
