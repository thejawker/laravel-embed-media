<?php

namespace TheJawker\LaravelEmbedMedia;

use TheJawker\LaravelEmbedMedia\MediaProviders\MediaProviderContract;

class MediaResolver
{
    protected static $instance = null;

    public $providers = [];

    public static function instance(): self
    {
        if (!isset(self::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function register(MediaProviderContract $provider)
    {
        self::instance()->providers[$provider->getServiceAccessor()] = $provider;
    }

    public static function resolve(string $serviceIdentifier): MediaProviderContract
    {
        return self::instance()->providers[$serviceIdentifier];
    }

    private static function providers(): array
    {
        return self::instance()->providers;
    }

    private static function isRegistered(MediaProviderContract $provider): bool
    {
        return key_exists($provider->getServiceAccessor(), self::providers());
    }
}