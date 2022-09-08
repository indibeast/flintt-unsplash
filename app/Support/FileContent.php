<?php

namespace App\Support;

class FileContent
{
    public static function fromUrl($url): string
    {
        return file_get_contents($url);
    }
}
