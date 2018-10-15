<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

abstract class BaseMediaProvider implements MediaProviderContract
{
    public $media_id = null;

    public function setMediaId(string $id)
    {
        $this->media_id = $id;
    }

    public function getMediaId(): string
    {
        return $this->media_id;
    }
}