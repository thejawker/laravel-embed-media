<?php

namespace TheJawker\LaravelEmbedMedia;

use Illuminate\Support\ServiceProvider;
use TheJawker\LaravelEmbedMedia\MediaProviders\VimeoMediaProvider;
use TheJawker\LaravelEmbedMedia\MediaProviders\YouTubeMediaProvider;

class EmbedMediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/embed-media.php' => config_path('embed-media.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../database');

        $this->loadMediaProviders();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/embed-media.php', 'embed-media');
    }

    private function loadMediaProviders()
    {
        MediaResolver::register(new YouTubeMediaProvider);
        MediaResolver::register(new VimeoMediaProvider);
    }
}
