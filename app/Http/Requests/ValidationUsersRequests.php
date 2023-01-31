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
            'username' => ['required', 'max:60', 'min:2'],
            'first_name' => ['alpha', 'max:40', 'min:2' ],
            'last_name' => ['alpha', 'max:40', 'min:2'],
            'telephone' => ['regex:/^(?:(?:(?:(?:\+|00)\d{2})?[ -]?(?:(?:\(0?\d{2}\))|(?:0?\d{2})))?[ -]?(?:\d{3}[- ]?\d{2}[- ]?\d{2}|\d{2}[- ]?\d{2}[- ]?\d{3}|\d{7})|(?:(?:(?:\+|00)\d{2})?[ -]?\d{3}[ -]?\d{3}[ -]?\d{3}))$/'],
            'NIP' => ['numeric', 'digits:10'],
            'password' => ['required', 'max:300', 'min:8'],
            'email' => ['required', 'email:rfc'],
            'join_date' => ['date_format:Y-m-d']
        ];
    }
}
