<?php

namespace App\Http\Requests;

use App\Services\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;

class CheckoutPost extends FormRequest
{

    public $ref_pagamento = null;
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
            'nif' => 'nullable|numeric',
            'tipo_pagamento' => ['required', Rule::in(['PAYPAL', 'VISA', 'MBWAY'])],
            'email' => ['required_if:tipo_pagamento,PAYPAL'],
            'card_number' => ['required_if:tipo_pagamento,VISA'],
            'cvc' => ['required_if:tipo_pagamento,VISA'],
            'phone_number' => ['required_if:tipo_pagamento,MBWAY'],
        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {

        $validator->after(function ($validator) {
            $data = $validator->getData();
            switch ($data['tipo_pagamento']) {
                case 'VISA':
                    if (!Payment::payWithVisa($data['card_number'], $data['cvc'])) {
                        $validator->errors()->add('cvc', __('VISA payment failed'));
                        $validator->errors()->add('card_number', __('VISA payment failed'));
                    };
                    $this->ref_pagamento = $data['card_number'];
                    break;
                case 'PAYPAL':
                    if (!Payment::payWithPaypal($data['email'])) {
                        $validator->errors()->add('email', __('Paypal payment failed'));
                    };
                    $this->ref_pagamento = $data['email'];
                    break;
                case 'MBWAY':
                    if (!Payment::payWithMBway($data['phone_number'])) {
                        $validator->errors()->add('phone_number', __('MBWAY payment failed'));
                    };
                    $this->ref_pagamento = $data['phone_number'];
                    break;
            }

            $validator->setData($data);
            $this->merge(["dwq" => "dwq"]);
        });
    }


    /**
     * Adicionar a variavel ref_pagamento ao array devolvido pelo metodo validated()
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function validated()
    {
        return array_merge(parent::validated(), [
            'ref_pagamento' => $this->ref_pagamento,
        ]);
    }
}
