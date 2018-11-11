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
        if (! class_exists('CreateEmbeddableMediaTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_embeddable_media_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_embeddable_media_table.php'),
            ], 'migrations');
        }

        $this->publishes([
            __DIR__ . '/../config/embed-media.php' => config_path('embed-media.php'),
        ], 'config');

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
