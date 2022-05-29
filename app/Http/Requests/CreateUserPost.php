<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipo' => ['required', Rule::in(['A', 'F'])],
            'foto_url' => ['nullable', 'image', 'max:8192'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Name'),
            'email' => __('Email'),
            'password' => __('Password'),
            'tipo' => __('Type'),
            'foto_url' => __('User Photo'),
        ];
    }
}
