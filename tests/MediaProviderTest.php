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
    public function registering_a_provider_twice_will_update_it()
    {
        $providerA = new ExampleMediaProvider('duplicate');
        $providerB = new ExampleMediaProvider('duplicate');

        MediaResolver::register($providerA);
        MediaResolver::register($providerB);

        $resolvedProvider = MediaResolver::resolve('duplicate');

        $this->assertTrue(spl_object_hash($resolvedProvider) === spl_object_hash($providerB));
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