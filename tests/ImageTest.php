<?php

namespace Tests;

use poldixd\ImgProxy\Contracts\ImageSignatureContract;
use poldixd\ImgProxy\Image;

class ImageTest extends TestCase
{
    /** @test */
    public function can_get_encoded_image_url()
    {
        $image = (new Image)
            ->setOriginalPictureUrl('https://example.org/assets/image.jpg')
            ->setWidth(800)
            ->setHeight(600)
            ->setExtension('jpg');

        app()->instance(Image::class, $image);

        $url = app(ImageSignatureContract::class)->getUrl();

        $this->assertEquals('/A0rVSeZ8HLWofFCY66OcANPeXwi3CjLg03tWrUZNiSA/w:800/h:600/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.jpg', $url);
    }

    /** @test */
    public function can_get_encoded_image_url_with_gravity()
    {
        $image = (new Image)
            ->setOriginalPictureUrl('https://example.org/assets/image.jpg')
            ->setGravity('noea', 123, 123)
            ->setExtension('jpg');

        app()->instance(Image::class, $image);

        $url = app(ImageSignatureContract::class)->getUrl();

        $this->assertEquals('/9dF1RyriHLo7y2vZVAH5qHc9APHTR9pkT6Qqn1WJ17M/g:noea:123:123/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.jpg', $url);
    }

    /** @test */
    public function can_get_encoded_image_url_with_resizing_type()
    {
        $image = (new Image)
            ->setOriginalPictureUrl('https://example.org/assets/image.jpg')
            ->setResizingType('fill')
            ->setExtension('jpg');

        app()->instance(Image::class, $image);

        $url = app(ImageSignatureContract::class)->getUrl();

        $this->assertEquals('/2swMkkwbBK4vJ3yk-j1hScWOyXSEthqtP4mN5ko-Pbg/rt:fill/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.jpg', $url);
    }

    /** @test */
    public function can_get_encoded_image_url_with_quality()
    {
        $image = (new Image)
            ->setOriginalPictureUrl('https://example.org/assets/image.jpg')
            ->setQuality(79)
            ->setExtension('jpg');

        app()->instance(Image::class, $image);

        $url = app(ImageSignatureContract::class)->getUrl();

        $this->assertEquals('/dLFgvOZbpnx3G5FcJzLBW83HPTLubkteTsYxJiXvxSs/q:79/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.jpg', $url);
    } 
}
