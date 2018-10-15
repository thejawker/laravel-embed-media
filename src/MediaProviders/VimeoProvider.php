<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

use Zttp\Zttp;

class VimeoProvider extends BaseMediaProvider
{
    const OEMBED_URL = 'https://vimeo.com/api/oembed.json?url=%s';

    public static function getServiceAccessor(): string
    {
        return 'vimeo';
    }

    private function getVideo()
    {
        $response = Zttp::get(sprintf(self::OEMBED_URL, $this->getMediaId()));

        return $response->json();
    }

    public function getHtml(): string
    {
        return $this->getVideo()['html'];
    }

    public function getRawData(): array
    {
        return $this->getVideo();
    }
}