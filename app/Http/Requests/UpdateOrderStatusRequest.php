<?php

namespace App\Http\Requests;

use App\Utils\Enum\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateOrderStatusRequest extends FormRequest
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
            'status' => [new Enum(OrderStatus::class)]
        ];
    }

    public function getStatus(): OrderStatus
    {
        return OrderStatus::from($this->input('status'));
    }
}
