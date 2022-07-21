<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:1|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'nullable|int|exists:categories,id',
            'price' => 'required|int',
            'image' => 'nullable|max:' . config('media-library.max_file_size') / 1024
        ];
    }

    /**
     * @return array
     */
    public function getInsertData(): array
    {
        return $this->only([
            'title',
            'description',
            'category_id',
            'price'
        ]);
    }

    /**
     * @return UploadedFile|null
     */
    public function getImage(): ?UploadedFile
    {
        return $this->file('image');
    }
}
