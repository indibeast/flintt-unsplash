<?php

namespace App\Providers;

use App\Images\ImageGallery;
use App\Images\Unsplash\UnsplashClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ImageGallery::class, UnsplashClient::class);
    }
}
