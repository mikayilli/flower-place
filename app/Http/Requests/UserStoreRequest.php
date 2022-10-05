<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "phone" => "required|regex:^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$^|unique:users,phone,".request('id'),
            "password" => ["required_without:id", "confirmed", Rule::when(!request('id'), ['min:6'])],
            "email" => "required|email|unique:users,email,".request('id'),
            "full_name" => "required|max:50",
            "status" => "required|in:1,0",
            'roles' => 'required'
        ];
    }

    public function messages()
    {
        return [
            "password.required_without" => "The password field is required"
        ];
    }
}
