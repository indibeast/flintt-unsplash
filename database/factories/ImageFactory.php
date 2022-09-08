<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */

class ImageFactory extends Factory
{
    public function definition()
    {
        return [
            'uuid' => (string) Uuid::uuid4(),
            'description' => 'test',
            'unsplash_id' => '1234',
            'path' => 'image/path'
        ];
    }
}
