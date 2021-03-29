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

        $this->assertEquals('/syb6T6yT4DADdsLdERUjeiG6XYYz5EmjKtaa3flmcCA/w:800/h:600/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.jpg', $url);
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

        $this->assertEquals('/95aJoJ6ewDG3Y5VkoC80hy7iX-3AHFClY6DeP7Oyc5I/g:noea:123:123/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.jpg', $url);
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

        $this->assertEquals('/lGJXJNtyY9C-gHJCkUg5WidP_DrEU39hIvpK8UoRHIs/rt:fill/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.jpg', $url);
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

        $this->assertEquals('/2J0ntEdvwKn_yYOJz2G2xXlSknMOaGX3P_ucUIo0wuk/q:79/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.jpg', $url);
    } 
}
