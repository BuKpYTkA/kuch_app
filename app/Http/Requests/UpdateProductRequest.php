<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends CreateProductRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'delete_image' => 'nullable|boolean'
        ]);
    }

    /**
     * @return bool
     */
    public function shouldDeleteImage(): bool
    {
        return !$this->getImage() && $this->get('delete_image', false);
    }
}
