<?php

namespace poldixd\ImgProxy\Providers;

use Illuminate\Support\ServiceProvider;
use poldixd\ImgProxy\Contracts\ImageSignatureContract;
use poldixd\ImgProxy\Image;
use poldixd\ImgProxy\ImageSignature;

class ImgProxyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/img-proxy.php' => config_path('img-proxy.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind(ImageSignatureContract::class, function ($app) {
            return new ImageSignature($app->make(Image::class));
        });
    }
}