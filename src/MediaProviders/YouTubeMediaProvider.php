<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

use Madcoda\Youtube\Youtube;

class YouTubeMediaProvider extends BaseMediaProvider
{
    protected $client;
    protected $video;

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
        if (property_exists($this->video(), 'player')) {
            return $this->video()->player->embedHtml;
        }

        return '<div>Video unavailable</div>';
    }

    private function video()
    {
        if (!$this->video || $this->video->id !== $this->media_id) {
            $this->video = $this->client->getVideoInfo($this->getMediaId());
        }

        return $this->video;
    }

    public function getRawData(): array
    {
        return json_decode(json_encode($this->video()), true);
    }

    public function getThumbnailUrl(): ?string
    {
        return array_get($this->getRawData(), 'snippet.thumbnails.maxres.url');
    }
}