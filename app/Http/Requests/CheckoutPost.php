<?php

namespace App\Http\Requests;

use App\Services\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;

class CheckoutPost extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'nif' => 'required|numeric',
            'tipo_pagamento' => ['required', Rule::in(['PAYPAL', 'VISA', 'MBWAY'])],
            'ref_pagamento' => ['required', function ($attribute, $value, $fail) use ($request) {
                switch ($request->tipo_pagamento) {
                    case 'VISA':
                        //TODO
                        break;
                    case 'PAYPAL':
                        if (!Payment::payWithPaypal($value)) {
                            $fail(__('Paypal payment failed'));
                        };
                        break;
                    case 'MBWAY':
                        if (!Payment::payWithMBway($value)) {
                            $fail(__('MBWAY payment failed'));
                        };
                        break;

                    default:
                        $fail($attribute . ' is invalid.');
                        break;
                }
            }],
        ];
    }
}
