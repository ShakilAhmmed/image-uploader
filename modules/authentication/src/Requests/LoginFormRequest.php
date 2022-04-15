<?php

namespace ShakilAhmmed\ImageUploader\Authentication\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'email|required',
            'password' => 'required'
        ];
    }
}
