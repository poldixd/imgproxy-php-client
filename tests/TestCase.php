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

    protected function getEnvironmentSetUp($app)
    {
        $config = require __DIR__ . '/../src/poldixd/ImgProxy/config/img-proxy.php';

        $app['config']->set('img-proxy', $config);
        $app['config']->set('app.key', '22367262343462424849646393285854');
        $app['config']->set('img-proxy.salt', '709d153f359897f4955f6f779a76ff29');
        $app['config']->set('img-proxy.key', '709d153f359897f4955f6f779a76ff29');
    }
}
