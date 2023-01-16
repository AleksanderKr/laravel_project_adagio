<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationUsersRequests extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required', 'alpha', 'max:60', 'min:2'],
            'first_name' => ['required', 'alpha', 'max:40', 'min:2' ],
            'last_name' => ['required', 'alpha', 'max:40', 'min:2'],
            'telephone' => ['required', 'regex:/^(?:(?:(?:(?:\+|00)\d{2})?[ -]?(?:(?:\(0?\d{2}\))|(?:0?\d{2})))?[ -]?(?:\d{3}[- ]?\d{2}[- ]?\d{2}|\d{2}[- ]?\d{2}[- ]?\d{3}|\d{7})|(?:(?:(?:\+|00)\d{2})?[ -]?\d{3}[ -]?\d{3}[ -]?\d{3}))$/'],
            'NIP' => ['required', 'numeric', 'digits:10'],  # telephone validation problem: possible "+48" or lack thereof
            'password' => ['required', 'max:40', 'min:8'],
            'email' => ['required', 'email:rfc'],
            'join_date' => ['required', 'date_format:Y-m-d']
        ];
    }
}