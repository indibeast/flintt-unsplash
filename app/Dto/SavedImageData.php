<?php

namespace App\Dto;

use App\Models\Image;
use Spatie\DataTransferObject\DataTransferObject;

class SavedImageData extends DataTransferObject
{
    public int $id;
    public string $uuid;
    public string $url;

    public static function fromModel(Image $image): self
    {
        return new self([
            'id' => $image->id,
            'uuid' => $image->uuid,
            'url' => route('image.view', ['uuid' => $image->uuid]),
        ]);
    }
}
