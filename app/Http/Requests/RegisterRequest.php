<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorized(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()->symbols()
            ],
            'name' => 'required|string|min:1|max:255',
        ];
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getPassword(): string
    {
        return $this->input('password');
    }

    public function getName(): string
    {
        return $this->input('name');
    }
}
