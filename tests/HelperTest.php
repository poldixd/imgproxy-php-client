<?php

namespace Tests;

use poldixd\ImgProxy\Contracts\ImageSignatureContract;
use poldixd\ImgProxy\Image;

class HelperTest extends TestCase
{
    /** @test */
    public function can_get_encoded_image_url()
    {
        $url = imgProxyResize('https://example.org/assets/image.jpg', 800, 600, 79, 'webp');

        $this->assertEquals('/s5EO8k8pNiw-MHrMpIWL1w0uELYMEXwO8jDGo4c_NOM/w:800/h:600/g:ce:0:0/rt:fill/q:79/aHR0cHM6Ly9leGFtcGxlLm9yZy9hc3NldHMvaW1hZ2UuanBn.webp', $url);
    }
}
