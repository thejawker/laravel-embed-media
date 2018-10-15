<?php

namespace TheJawker\LaravelEmbedMedia\Tests\Integration;

use TheJawker\LaravelEmbedMedia\EmbeddableMedia;
use TheJawker\LaravelEmbedMedia\MediaProviders\YouTubeMediaProvider;
use TheJawker\LaravelEmbedMedia\MediaResolver;

/** @group external */
class YouTubeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        MediaResolver::register(new YouTubeMediaProvider);
    }

    /** @test */
    public function the_iframe_is_retrievable_on_the_youtube_provider()
    {
        $media = $this->mediaFactory();

        $this->assertEquals('<iframe width="480" height="270" src="//www.youtube.com/embed/bdM9c2OFYuw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>', $media->html);
    }

    /** @test */
    public function raw_data_can_be_retrieved_from_the_provider()
    {
        $media = $this->mediaFactory();

        $this->assertArraySubset([
            'kind' => 'youtube#video',
            'id' => 'bdM9c2OFYuw',
            'snippet' => [
                'publishedAt' => '2018-02-14T16:06:19.000Z'
            ]
        ], $media->raw_data);
    }

    private function mediaFactory(): EmbeddableMedia
    {
        $media = new EmbeddableMedia();
        $media->service_accessor = 'youtube';
        $media->media_id = 'bdM9c2OFYuw';
        
        return $media;
    }
}