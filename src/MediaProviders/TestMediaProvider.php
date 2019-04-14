<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

class TestMediaProvider extends BaseMediaProvider
{
    public static function getServiceAccessor(): string
    {
        return 'test';
    }

    public function getHtml(): string
    {
        return '<div>Very Valid Video</div>';
    }

    public function getRawData(): array
    {
        return [
            'video' => 'valid'
        ];
    }

    public function getThumbnailUrl(): ?string
    {
        return 'https://knowyourmeme.com/photos/96044';
    }
}