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

    public function authorize()
    {
        return $this->user()->can('update', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->route('user')) {
            $user = User::findOrFail($this->route('user')->id);
        }
        return [
            'name' => ['required', 'string', 'max:255'],
            // ignore serve para nao verificarmos se o email inserido é igual ao email do utilizador que estamos a editar
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id),],
            'tipo' => [Rule::in(['A', 'F']), function ($attribute, $value, $fail) {
                if (!auth()->user()->isAdmin()) {
                    $fail('The ' . $attribute . ' is invalid.');
                    if (!$value) {
                        $fail('The ' . $attribute . ' is required.');
                    }
                }
            },],
            'foto_url' => ['nullable', 'image', 'max:8192'],

        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Name'),
            'email' => __('Email'),
            'tipo' => __('Type'),
            'foto_url' => __('User Photo'),
        ];
    }
}
