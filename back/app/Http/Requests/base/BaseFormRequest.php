<?php

namespace App\Http\Requests\base;

use App\Http\Services\Logging;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BaseFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();

        if ($this->expectsJson() && count($errors) > 0) {
            App::call(function (Logging $logging) use ($errors) {
                $logging->validationLog($errors);
            });

        }
        parent::failedValidation($validator);
    }
}
