<?php

namespace App\Images;

use App\Dto\ImageData;
use App\Dto\PaginationData;

interface ImageGallery
{
    public function search(string $search): ?PaginationData;

    public function retrieve(string $id): ?ImageData;
}
