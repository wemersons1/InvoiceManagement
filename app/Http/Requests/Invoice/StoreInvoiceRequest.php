<?php

namespace App\Http\Requests\Invoice;

use App\Rules\Cnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number' => 'required|size:9', 
            'value' => 'required|numeric|min:1', 
            'date_of_issue' => 'required|date_format:Y-m-d H:i:s|before_or_equal:now', 
            'sender_cnpj' => ['required', 'size:14', new Cnpj],
            'sender_name' => 'required|string|max:255', 
            'transporter_cnpj' => ['required', 'size:14', new Cnpj],
            'transporter_name' => 'required|string|max:255'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => __('validation.invalid_input'),
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST)
        );
    }
}
