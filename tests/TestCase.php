<?php

namespace Tests;

use poldixd\ImgProxy\Providers\ImgProxyServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ImgProxyServiceProvider::class,
        ];
    }
}
