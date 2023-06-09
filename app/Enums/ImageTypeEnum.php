<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ImageTypeEnum: int
{
    use Options, Values, InvokableCases;

    case CARD = 1;

}
