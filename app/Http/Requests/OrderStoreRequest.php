<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
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
            "cards" => "required|array|min:1",
            "cards.*" => "required|array",
            "cards.*.slug" => "required",
            "cards.*.count" => "required|integer|min:1",
            "cards.*.items" => "nullable|array",
            "cards.*.items.*" => "nullable|array",
            "cards.*.items.*.slug" => "required_with:cards.*.items.*",
            "cards.*.items.*.count" => "required_with:cards.*.items.*|min:1",
            "delivery" => "required|array",
            "delivery.method" => "required|in:delivery,pickup,tome",
            "delivery.sender.phone" => ['required'],
            "delivery.sender.full_name" => ['required'],
            "delivery.recipient.phone" => ['required_if:delivery.method,delivery'],
            "delivery.recipient.full_name" => ['required_if:delivery.method,delivery'],
            "delivery.send_date" => [
                'required_if:delivery.method,delivery',
                'required_if:delivery.method,tome',
                "nullable",
                "date_format:Y-m-d",
                "after_or_equal:".date("Y-m-d")
            ],
            "delivery.send_time" => [
                'required_if:delivery.method,delivery',
                'required_if:delivery.method,tome',
                "nullable",
                "date_format:H:i"
            ],
            "delivery.pickup" => ["required_if:delivery.method,pickup"],
            "payment" => "required|array",
            "payment.type" => "required|in:cart,cash"
        ];
    }

    public function messages()
    {
        return [
            "delivery.pickup.required_if" => "you should select a store"
        ];
    }
}
