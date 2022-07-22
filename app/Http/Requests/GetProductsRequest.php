<?php

namespace App\Http\Requests;

use App\Utils\Enum\OrderDirection;
use App\Utils\Enum\ProductsOrderingType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GetProductsRequest extends FormRequest
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
            'order_by' => [
                'nullable',
                'string',
                new Enum(ProductsOrderingType::class)
            ],
            'direction' => [
                'nullable',
                'string',
                'required_with:order_by',
                new Enum(OrderDirection::class)
            ],
            'price_min' => 'nullable|int',
            'price_max' => 'nullable|int'
        ];
    }

    public function hasOrderBy(): bool
    {
        return $this->has('order_by');
    }

    public function getOrderBy(): ?ProductsOrderingType
    {
        return $this->hasOrderBy() ? ProductsOrderingType::from($this->input('order_by')) : null;
    }

    public function getOrderDirection(): ?OrderDirection
    {
        return $this->hasOrderBy() ? OrderDirection::from($this->input('direction')) : null;
    }

    public function hasPriceMin(): bool
    {
        return $this->has('price_min');
    }

    public function hasPriceMax(): bool
    {
        return $this->has('price_max');
    }

    public function getPriceMin(): ?int
    {
        return $this->input('price_min');
    }

    public function getPriceMax(): ?int
    {
        return $this->input('price_max');
    }
}
