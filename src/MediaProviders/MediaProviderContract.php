<?php

namespace TheJawker\LaravelEmbedMedia\MediaProviders;

interface MediaProviderContract
{
    public static function getServiceAccessor(): string;
    public function getHtml(): string;
    public function setMediaId(string $id);
    public function getMediaId(): string;
    public function getRawData(): array;
}