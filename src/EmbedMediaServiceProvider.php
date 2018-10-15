<?php

namespace TheJawker\LaravelEmbedMedia;

use Illuminate\Support\ServiceProvider;

class EmbedMediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/embed-media.php.php' => config_path('embed-media.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/embed-media.php', 'embed-media');
    }
}
