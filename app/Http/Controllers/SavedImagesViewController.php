<?php

namespace App\Http\Controllers;

use App\Dto\PaginationData;
use App\Dto\SavedImageData;
use App\Models\Image;
use Inertia\Inertia;

class SavedImagesViewController
{
    public function __invoke()
    {
        return Inertia::render('ImageGallery', [
            'images' => PaginationData::fromPaginator(Image::orderBy('created_at', 'desc')->paginate()->through(fn ($image) => SavedImageData::fromModel($image))),
        ]);
    }
}
