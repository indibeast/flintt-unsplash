<?php

namespace App\Actions;

use App\Dto\ImageData;
use App\Models\Image;
use App\Support\FileContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class SaveImageAction
{
    public function execute(ImageData $image)
    {
        $content = FileContent::fromUrl($image->downloadUrl);
        $name = (string) Uuid::uuid4();
        $path = 'unsplash-images/'.$name.'.jpg';
        Storage::put($path, $content);

        Image::create([
            'uuid' => $name,
            'path' => $path,
            'unsplash_id' => $image->id,
            'description' => Str::limit($image->description, 150)
        ]);
    }
}
