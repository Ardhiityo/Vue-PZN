<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'street' => ['required', 'min:3', 'max:255'],
            'city' => ['required', 'min:3', 'max:255'],
            'province' => ['required', 'min:3', 'max:255'],
            'postal_code' => ['required', 'min_digits:2', 'integer'],
            'country' => ['required', 'min:3', 'max:255']
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            response(
                $validator->getMessageBag(),
                400
            )
        );
    }
}
