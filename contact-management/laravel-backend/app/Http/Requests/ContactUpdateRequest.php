<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['nullable', 'max:255'],
            'email' => ['nullable', 'email:dns', 'min:8', 'max:100'],
            'phone' => ['nullable', 'min:8', 'max:15']
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
