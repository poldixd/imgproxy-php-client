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
}
