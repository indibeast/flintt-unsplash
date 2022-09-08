<?php

namespace App\Rules;

use App\Models\Image;
use Illuminate\Contracts\Validation\InvokableRule;

class DuplicateImage implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (Image::where('unsplash_id', $value)->exists()) {
            $fail('Image is already saved');
        }
    }
}
