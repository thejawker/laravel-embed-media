<?php

namespace TheJawker\LaravelEmbedMedia\Tests\Integration;

use Orchestra\Testbench\TestCase as Orchestra;
use TheJawker\LaravelEmbedMedia\EmbedMediaServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            EmbedMediaServiceProvider::class,
        ];
    }
}