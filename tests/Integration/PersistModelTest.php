<?php

namespace TheJawker\LaravelEmbedMedia\Tests\Integration;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use TheJawker\LaravelEmbedMedia\EmbeddableMedia;
use TheJawker\LaravelEmbedMedia\MediaResolver;
use TheJawker\LaravelEmbedMedia\Tests\ExampleMediaProvider;
use TheJawker\LaravelEmbedMedia\Tests\ExampleModel;

class PersistModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        Schema::create('example_models', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('embeddable_media', function (Blueprint $table) {
            $table->increments('id');

            $table->string('service_accessor');
            $table->string('media_id');

            $table->integer('embeddable_id')->unsigned();
            $table->string('embeddable_type');

            $table->timestamps();
        });
    }

    /** @test */
    public function can_be_associated_with_a_model()
    {
        MediaResolver::register(new ExampleMediaProvider('example'));
        $exampleModel = ExampleModel::create();

        $media = new EmbeddableMedia();
        $media->service_accessor = 'example';
        $media->media_id = 'abcdefg';

        $exampleModel->embeddableMedia()->save($media);

        $this->assertTrue($exampleModel->embeddableMedia()->first()->is($media));
    }
}