<?php

namespace App\Http\Requests\auth;

use App\Http\Requests\base\BaseFormRequest;

class RegistrationRequest extends BaseFormRequest
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
            "name" => ['required', 'alpha'],
            "last_name" => ['required', 'alpha'],
            "email" => ['required', 'email:rfc,dns', 'unique:users,email'],
            "password" => ['required', 'min:8', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо заполнить имя',
            'name.alpha' => 'Имя может содержать только буквы',

            'last_name.required' => 'Необходимо заполнить фамилию',
            'last_name.alpha' => 'Фамилия может содержать только буквы',

            'email.required' => 'Необходимо заполнить email',
            'email.email' => 'Указан некорректный email',
            'email.unique' => 'Email уже зарегистрирован',

            'password.required' => 'Необходимо заполнить пароль',
            'password.min' => 'Минимальная длинная пароля :min символов',
            'password.confirmed' => 'Введенные пароли не совпадают',
        ];
    }
}
