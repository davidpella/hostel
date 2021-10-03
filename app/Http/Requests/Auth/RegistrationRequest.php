<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => [
                'required', 'string', 'max:255'
            ],
            'first_name' => [
                'required', 'string', 'max:255'
            ],
            'last_name' => [
                'required', 'string', 'max:255'
            ],
            'middle_name' => [
                'nullable', 'string', 'max:255'
            ],
            'gender' => [
                'nullable', 'string', 'max:255', Rule::in(['male', 'female'])
            ],
            'email' => [
                'required', 'string', 'email', 'max:255', 'unique:users'
            ],
            'phone_number' => [
                'required', 'string', 'max:255', 'unique:alumni'
            ],
            'city' => [
                'required', 'string', 'max:255',
            ],
            'educational_level' => [
                'required', 'string', 'max:255',
            ],
            'country' => [
                'required', 'string', 'max:255',
            ],
            'password' => [
                'required', 'confirmed', Password::defaults()
            ],
        ];
    }
}
