<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    protected $errorBag = "register";

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
            "full_name" => "required",
            "email" => "required|email|unique:customers",
            "password" => "required|min:6",
            "phone" => "required|unique:customers",
        ];
    }

    public function messages()
    {
        return [
            "full_name.required" => "Поле Имя/Фамилия является обязательным.",
            "email.required" => "Поле адреса электронной почты обязательно для заполнения.",
            "email.email" => "Электронная почта должна быть действующим адресом электронной почты.",
            "email.unique" => "Электронная почта уже занята.",
            "phone.required" => "Поле телефона обязательно для заполнения.",
            "phone.unique" => "Телефон уже забрали.",
            "password.required" => "Поле пароля обязательно для заполнения.",
        ];
    }

}
