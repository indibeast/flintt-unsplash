<?php

namespace App\Images\Unsplash;

use App\Dto\ImageData;
use App\Dto\PaginationData;
use App\Images\ImageGallery;
use App\Images\Unsplash\Requests\GetImageRequest;
use App\Images\Unsplash\Requests\SearchImagesRequest;

class UnsplashClient implements ImageGallery
{
    public function retrieve(string $id): ?ImageData
    {
        $request = new GetImageRequest($id);

        return $request->send()->dto();
    }

    public function search(string $search, $page = 1): ?PaginationData
    {
        $request = new SearchImagesRequest(search:$search);
        $request->mergeQuery(['page' => $page, 'per_page' => 20]);

        return $request->send()->dto();
    }
}
