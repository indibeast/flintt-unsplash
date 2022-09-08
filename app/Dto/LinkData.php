<?php

namespace App\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class LinkData extends DataTransferObject
{
    public string $href;
    public string $label;
}
