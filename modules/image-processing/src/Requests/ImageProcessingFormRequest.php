<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ImageProcessingFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'image_url' => ['required']
        ];
    }
}
