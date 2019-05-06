<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

class SpotifyMediaProvider extends BaseMediaProvider
{
    public static function getServiceAccessor(): string
    {
        return 'spotify';
    }

    public function getHtml(): string
    {
        return sprintf('<iframe src="https://embed.spotify.com/?uri=%s" width="300" height="380" frameBorder="0" allowTransparency="true" />', $this->media_id);
    }

    public function getRawData(): array
    {
        return [
            "uri" => $this->media_id,
            "iframe" => $this->getHtml()
        ];
    }

    public function getThumbnailUrl(): ?string
    {
        return null;
    }
}