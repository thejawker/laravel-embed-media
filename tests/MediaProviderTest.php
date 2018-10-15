<?php

namespace TheJawker\Tests;

use PHPUnit\Framework\TestCase;
use TheJawker\LaravelEmbedMedia\MediaProviders\MediaProviderContract;
use TheJawker\LaravelEmbedMedia\MediaResolver;
use TheJawker\LaravelEmbedMedia\Tests\ExampleMediaProvider;
use TheJawker\LaravelEmbedMedia\ClashingServiceIdentifierException;

class ProviderTest extends TestCase
{
    /** @test */
    public function a_provider_can_be_instantiated()
    {
        MediaResolver::register(new ExampleMediaProvider);

        $resolvedMedia = MediaResolver::resolve('service-name');

        $this->assertInstanceOf(MediaProviderContract::class, $resolvedMedia);
    }
    
    /** @test */
    public function cant_register_two_providers_with_the_same_service_identifier()
    {
        $this->expectException(ClashingServiceIdentifierException::class);

        MediaResolver::register(new ExampleMediaProvider('duplicate'));
        MediaResolver::register(new ExampleMediaProvider('duplicate'));
    }

    /** @test */
    public function html_can_be_returned()
    {
        MediaResolver::register(new ExampleMediaProvider);

        $resolvedMedia = MediaResolver::resolve('service-name');
        $resolvedMedia->setMediaId('abcdefg');

        $this->assertEquals('<iframe src="https://things.com/abcdefg"></iframe>', $resolvedMedia->getHtml());
    }
}