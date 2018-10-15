<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

use Madcoda\Youtube\Youtube;

class YouTubeMediaProvider extends BaseMediaProvider
{
    protected $client;

    public function __construct()
    {
        try {
            $this->client = new Youtube([
                'key' => config('embed-media.youtube-key')
            ]);
        } catch (\Exception $exception) {
            //
        }
    }

    public static function getServiceAccessor(): string
    {
        return 'youtube';
    }

    public function getHtml(): string
    {
        return $this->video()->player->embedHtml;
    }

    private function video()
    {
        return $this->client->getVideoInfo($this->getMediaId());
    }

    public function getRawData(): array
    {
        return json_decode(json_encode($this->video()), true);
    }
}