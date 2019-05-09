<?php

namespace TheJawker\LaravelEmbedMedia\Tests\Integration;

use TheJawker\LaravelEmbedMedia\EmbeddableMedia;

class SoundCloudTest extends TestCase
{
    /** @test */
    public function iframe_can_be_returned_for_the_spotify_provider()
    {
        $media = $this->getMedia();
        $this->assertEquals('<iframe width="100%" height="300" scrolling="yes" frameBorder="no" src="https://w.soundcloud.com/player/?url=https://api.soundcloud.com/tracks/255924011&color=0066cc&auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=false"></iframe>', $media->html);
    }

    /** @test */
    public function raw_data_can_be_retrieved_from_the_provider()
    {
        $media = $this->getMedia();

        $this->assertArraySubset([
            'title' => 'Zephyr',
            'id' => '255924011',
            'user' => [
                'username' => 'DYSSEBIA'
            ]
        ], $media->raw_data);
    }

    private function getMedia(): EmbeddableMedia
    {
        $media = new EmbeddableMedia();
        $media->service_accessor = 'soundcloud';
        $media->media_id = 'https://soundcloud.com/dyssebia/zephyr';

        return $media;
    }
}