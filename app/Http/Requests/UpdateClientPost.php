<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cliente;
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
        return true;
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
            'nif' => ['nullable', 'numeric', 'digits:9'],
            'tipo_pagamento' => ['nullable', Rule::in(['MBWAY', 'VISA', 'NULL', 'PAYPAL'])],
            'foto_url' => ['nullable', 'image', 'max:8192']
        ];
    }
}
