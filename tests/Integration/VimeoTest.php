<?php

namespace TheJawker\LaravelEmbedMedia\Tests\Integration;

use TheJawker\LaravelEmbedMedia\EmbeddableMedia;
use TheJawker\LaravelEmbedMedia\MediaProviders\VimeoProvider;
use TheJawker\LaravelEmbedMedia\MediaResolver;

/** @group external */
class VimeoTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        MediaResolver::register(new VimeoProvider);
    }

    /** @test */
    public function iframe_can_be_returned_for_the_vimeo_provider()
    {
        $media = $this->getMedia();

        $this->assertEquals('<iframe src="https://player.vimeo.com/video/76979871?app_id=122963" width="480" height="270" frameborder="0" title="The New Vimeo Player (You Know, For Videos)" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', $media->html);
    }
    
    /** @test */
    public function data_can_be_returned()
    {
        $media = $this->getMedia();

        $this->assertArraySubset([
            'thumbnail_url' => 'https://i.vimeocdn.com/video/452001751_295x166.jpg',
            'thumbnail_width' => 295,
            'thumbnail_height' => 166,
            'thumbnail_url_with_play_button' => 'https://i.vimeocdn.com/filter/overlay?src0=https%3A%2F%2Fi.vimeocdn.com%2Fvideo%2F452001751_295x166.jpg&src1=http%3A%2F%2Ff.vimeocdn.com%2Fp%2Fimages%2Fcrawler_play.png',
            'upload_date' => '2013-10-15 14:08:29',
            'video_id' => 76979871,
            'uri' => '/videos/76979871',
        ], $media->raw_data);
    }

    private function getMedia(): EmbeddableMedia
    {
        $media = new EmbeddableMedia();
        $media->service_accessor = 'vimeo';
        $media->media_id = 'https://vimeo.com/76979871';

        return $media;
    }
}