<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Validation\Rule;

class UpdateClientPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update',Cliente::class);
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
            'nif' => ['nullable','numeric','max:9'],
            'tipo_pagamento' => ['nullable', Rule::in(['MBWAY', 'VISA','NULL','PAYPAL'])],
            'foto_url' => ['nullable', 'image', 'max:8192']
        ];
    }
}
