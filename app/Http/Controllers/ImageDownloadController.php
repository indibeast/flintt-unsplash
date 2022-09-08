<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageSaveRequest;
use App\Images\ImageGallery;
use Facades\App\Actions\SaveImageAction;

class ImageDownloadController
{
    public function __invoke(ImageGallery $imageGallery, ImageSaveRequest $request)
    {
        SaveImageAction::execute($imageGallery->retrieve($request->get('id')));

        return redirect()->back()->with('success', 'Image saved successfully');// can be put to lang file
    }
}
