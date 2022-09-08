<?php

namespace App\Dto;

use App\Models\Image;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class ImageData extends DataTransferObject
{
    public string $id;
    public ?string $description;
    public string $regularUrl;
    public string $smallUrl;
    public string $downloadUrl;
    public string $createdBy;
    public string $createdAt;
    public bool $isDownloaded;

    public static function fromUnsplash(array $image): ImageData
    {
        return new self([
            'id' => $image['id'],
            'description' => $image['description'],
            'regularUrl' => $image['urls']['regular'],
            'smallUrl' => $image['urls']['small'],
            'createdBy' => $image['user']['name'],
            'createdAt' => Carbon::parse($image['created_at'])->format('M d, Y'),
            'downloadUrl' => $image['links']['download'],
            'isDownloaded' => Image::where('unsplash_id', $image['id'])->exists(),
        ]);
    }
}
