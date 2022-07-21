<?php

namespace App\Http\Requests;

class AddShoppingCartItemRequest extends RemoveShoppingCartItemRequest
{

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'quantity' => 'required|int|min:1'
        ]);
    }

    public function getQuantity(): int
    {
        return $this->input('quantity');
    }
}
