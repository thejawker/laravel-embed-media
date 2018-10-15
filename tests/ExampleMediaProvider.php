<?php

namespace TheJawker\LaravelEmbedMedia\Tests;

use TheJawker\LaravelEmbedMedia\MediaProviders\BaseMediaProvider;

class ExampleMediaProvider extends BaseMediaProvider
{
    public static $serviceAccessor;

    public function __construct(string $serviceAccessor = 'service-name')
    {
        self::$serviceAccessor = $serviceAccessor;
    }

    public static function getServiceAccessor(): string
    {
        return self::$serviceAccessor;
    }

    public function getHtml(): string
    {
        return sprintf('<iframe src="https://things.com/%s"></iframe>', $this->getMediaId());
    }

    public function getRawData(): array
    {
        return [
            'things' => 'with-values',
            'and' => [
                'more' => 'values'
            ],
            'also' => $this->getMediaId(),
            'accessor' => self::getServiceAccessor()
        ];
    }
}