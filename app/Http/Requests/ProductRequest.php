<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "name" => "required_without:id",
            "height" => "required_without:id",
            "price" => "required_without:id|numeric|gte:0.1",
            "type_id" => "required_without:id",
            "status" => "required_without:id|boolean",
            "gallery" => "nullable|array|max:4",
            "gallery.*" => "required_with:gallery|image"
        ];
    }
}
