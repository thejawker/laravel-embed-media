<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

use Zttp\Zttp;

class VimeoMediaProvider extends BaseMediaProvider
{
    const OEMBED_URL = 'https://vimeo.com/api/oembed.json?url=%s';

    protected $video;

    public static function getServiceAccessor(): string
    {
        return 'vimeo';
    }

    private function getVideo()
    {
        if (!$this->video) {
            $response = Zttp::get(sprintf(self::OEMBED_URL, $this->getMediaId()));
            $this->video = $response->json();
        }

        return $this->video;
    }

    public function getHtml(): string
    {
        return $this->getVideo()['html'];
    }

    public function getRawData(): array
    {
        return $this->getVideo();
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->getVideo()['thumbnail_url'];
    }
}