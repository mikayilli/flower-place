<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $errorBag = "login";

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
        return [
            "phone" => "required",
            "password" => "required"
        ];
    }

    public function messages()
    {
        return [
            "phone.required" => "Поле телефона обязательно для заполнения.",
            "password.required" => "Поле пароля обязательно для заполнения.",
        ];
    }
}
