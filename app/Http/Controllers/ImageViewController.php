<?php

namespace App\Http\Controllers;

use App\Models\Image;

class ImageViewController
{
    public function __invoke($uuid)
    {
        $image = Image::where('uuid', $uuid)->firstOrFail();

        return response()->file(storage_path('/app/'.$image->path), ['Content-Type' => 'image/jpeg']);
    }
}
