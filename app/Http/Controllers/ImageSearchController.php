<?php

namespace App\Http\Controllers;

use App\Images\ImageGallery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImageSearchController
{
    public function __invoke(ImageGallery $imageGallery, Request $request)
    {
        $images = [];

        if ($request->has('search')) {
            $images = $imageGallery->search($request->get('search'), $request->get('page', 1));
        }

        return Inertia::render('ImageSearch', [
            'images' => $images,
            'hasSearchParam' => $request->has('search'),
            'hasApiError' => is_null($images)
        ]);
    }
}
