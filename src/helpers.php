<?php

use poldixd\ImgProxy\Contracts\ImageSignatureContract;
use poldixd\ImgProxy\Image;

if (!function_exists('imgProxyResize')) {

    function imgProxyResize(string $path, int $width, int $height, int $quality = 80, string $extension = 'jpg'): string
    {
        $image = (new Image)
            ->setOriginalPictureUrl($path)
            ->setWidth($width)
            ->setHeight($height)
            ->setQuality($quality)
            ->setExtension($extension);

        app()->instance(Image::class, $image);

        return config('img-proxy.base_url') . app(ImageSignatureContract::class)->getUrl();
    }
}
