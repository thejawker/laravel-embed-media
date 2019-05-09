<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

use Zttp\Zttp;

class SoundCloudMediaProvider extends BaseMediaProvider
{
    const RESOLVE_ENDPOINT = 'https://api.soundcloud.com/resolve.json';
    const RESOURCE_URL_TEMPLATE = "https://w.soundcloud.com/player/?url=%s&color=0066cc&auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=false";

    protected $media;

    public static function getServiceAccessor(): string
    {
        return 'soundcloud';
    }

    public function getHtml(): string
    {
        $id = $this->getMedia()['uri'];
        $resourceUrl = sprintf(self::RESOURCE_URL_TEMPLATE, $id);

        return sprintf('<iframe width="100%%" height="300" scrolling="yes" frameBorder="no" src="%s"></iframe>', $resourceUrl);
    }

    public function getRawData(): array
    {
        return $this->getMedia();
    }

    public function getThumbnailUrl(): ?string
    {
        $smallImageUrl = $this->getMedia()['artwork_url'];
        return str_replace('-large', '-t500x500', $smallImageUrl);
    }

    private function getMedia()
    {
        if (!$this->media) {
            $response = Zttp::get(self::RESOLVE_ENDPOINT, [
                'url' => $this->media_id,
                'client_id' => config('embed-media.soundcloud-key')
            ]);

            $this->media = $response->json();
        }

        return $this->media;
    }
}