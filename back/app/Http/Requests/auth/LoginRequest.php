<?php

namespace App\Http\Requests\auth;


use App\Http\Requests\base\BaseFormRequest;

class LoginRequest extends BaseFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => ['required', 'email:rfc,dns'],
            "password" => ['required']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Необходимо заполнить email',
            'email.email' => 'Указан некорректный email',
            'email.exists' => 'Email не зарегистрирован',

            'password.required' => 'Необходимо заполнить пароль',
        ];
    }
}
