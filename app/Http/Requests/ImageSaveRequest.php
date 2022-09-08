<?php

namespace App\Http\Requests;

use App\Rules\DuplicateImage;
use Illuminate\Foundation\Http\FormRequest;

class ImageSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', new DuplicateImage()],
        ];
    }
}
