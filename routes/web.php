<?php

use App\Http\Controllers\ImageDownloadController;
use App\Http\Controllers\ImageSearchController;
use App\Http\Controllers\SavedImagesViewController;
use App\Http\Controllers\ImageViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/images', ImageSearchController::class)->name('images.search');
Route::get('/saved-images', SavedImagesViewController::class)->name('images.saved');
Route::post('/image-download', ImageDownloadController::class)->name('image.download');
Route::get('/saved-image/{uuid}', ImageViewController::class)->name('image.view');
