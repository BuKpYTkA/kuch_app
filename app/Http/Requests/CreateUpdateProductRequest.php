<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class CreateUpdateProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|min:1|max:255',
            'description' => 'nullable|max:1000',
            'category_id' => 'nullable|exists:categories,id',
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
            'category_id'
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
