<?php

namespace TheJawker\LaravelEmbedMedia\Tests\Integration;

use TheJawker\LaravelEmbedMedia\EmbeddableMedia;

class SpotifyTest extends TestCase
{
    /** @test */
    public function iframe_can_be_returned_for_the_spotify_provider()
    {
        $media = $this->getMedia();

        $this->assertEquals('<iframe src="https://embed.spotify.com/?uri=spotify:album:11g90WRuoP800J0DOxKCNM" width="300" height="380" frameBorder="0" allowTransparency="true" />', $media->html);
    }

    /** @test */
    public function data_can_be_returned()
    {
        $media = $this->getMedia();

        $this->assertArraySubset([
            'thumbnail_url' => null,
            'uri' => 'spotify:album:11g90WRuoP800J0DOxKCNM',
        ], $media->raw_data);
    }

    private function getMedia(): EmbeddableMedia
    {
        $media = new EmbeddableMedia();
        $media->service_accessor = 'spotify';
        $media->media_id = 'spotify:album:11g90WRuoP800J0DOxKCNM';

        return $media;
    }
}