<?php

namespace TheJawker\LaravelEmbedMedia\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use TheJawker\LaravelEmbedMedia\MediaProviders\MediaProviderContract;
use TheJawker\LaravelEmbedMedia\MediaResolver;
use TheJawker\LaravelEmbedMedia\EmbeddableMedia;

class EmbeddableMediaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        MediaResolver::register(new ExampleMediaProvider('example'));
    }

    /** @test */
    public function an_embeddable_media_can_be_instantiated()
    {
        $media = new EmbeddableMedia();
        $media->service_accessor = 'example';
        $media->media_id = 'abcdefg';

        $this->assertInstanceOf(MediaProviderContract::class, $media->provider);
    }

    /** @test */
    public function a_media_id_is_set_on_the_provider()
    {
        $media = new EmbeddableMedia();
        $media->service_accessor = 'example';
        $media->media_id = 'abcdefg';

        $this->assertEquals('abcdefg', $media->provider->getMediaId());
    }

    /** @test */
    public function embeddable_html_can_be_retrieved()
    {
        $media = new EmbeddableMedia();
        $media->service_accessor = 'example';
        $media->media_id = 'abcdefg';

        $this->assertEquals('<iframe src="https://things.com/abcdefg"></iframe>', $media->html);
    }
    
    /** @test */
    public function raw_media_provider_data_can_be_retrieved()
    {
        /** @see ExampleMediaProvider for raw_data example implementation */
        $media = new EmbeddableMedia();
        $media->service_accessor = 'example';
        $media->media_id = 'abcdefg';

        $this->assertEquals([
            'things' => 'with-values',
            'and' => [
                'more' => 'values'
            ],
            'also' => 'abcdefg',
            'accessor' => 'example'
        ], $media->raw_data);
    }
}