<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateInvoiceRequest extends FormRequest
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
        return  [
            "customer_id" => 'required|numeric|min:1',
            "invoice_date" => 'required|date|date_format:Y-m-d',
            "due_date" => 'required|date|date_format:Y-m-d|after_or_equal:invoice_date',
            "currency" => 'required|string',
            "description"=>'required|array|min:1',
            "amount"=>'required|array|min:1',
            "taxed"=>'nullable|array',
            "sub_total"=>'required|numeric|min:1',
            "taxable_total"=>'required|numeric',
            "tax_rate"=>'nullable|numeric',
            "tax_amount"=>'nullable|numeric',
            "total_after_tax"=>'required|numeric|min:1',
            "amount_paid"=>'nullable|numeric',
            "amount_due"=>'required|numeric',
        ];
    }
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                "errors" => ["validation" => [$validator->errors()->first()]],
            ], 422)
        );
    }
}
