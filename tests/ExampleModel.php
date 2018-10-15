<?php

namespace TheJawker\LaravelEmbedMedia\Tests;

use Illuminate\Database\Eloquent\Model;
use TheJawker\LaravelEmbedMedia\EmbeddableMedia;

class ExampleModel extends Model
{
    public function embeddableMedia()
    {
        return $this->morphMany(EmbeddableMedia::class, 'embeddable');
    }
}