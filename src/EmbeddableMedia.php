<?php

namespace TheJawker\LaravelEmbedMedia;

use Illuminate\Database\Eloquent\Model;
use TheJawker\LaravelEmbedMedia\MediaProviders\MediaProviderContract;

class EmbeddableMedia extends Model
{
    protected $guarded = [];

    protected $appends = ['raw_data', 'html', 'thumbnail'];

    public function provider(): MediaProviderContract
    {
        $provider = MediaResolver::resolve($this->service_accessor);
        $provider->setMediaId($this->media_id);

        return $provider;
    }

    public function getProviderAttribute()
    {
        return $this->provider();
    }

    public function getHtmlAttribute()
    {
        return $this->provider()->getHtml();
    }

    public function getRawDataAttribute()
    {
        return $this->provider()->getRawData();
    }

    public function getThumbnailAttribute()
    {
        return $this->provider()->getThumbnailUrl();
    }
}