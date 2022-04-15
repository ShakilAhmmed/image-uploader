<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public static function setUri($uri): ImageService
    {
        return new static($uri);
    }

    private function getContents()
    {
        return file_get_contents($this->uri);
    }

    private function getFilePath(): string
    {
        return 'images/' . substr($this->uri, strrpos($this->uri, '/') + 1);
    }

    public function download(): string
    {
        Storage::put($this->getFilePath(), $this->getContents());
        return $this->getFilePath();
    }

}
