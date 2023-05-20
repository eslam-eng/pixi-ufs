<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ImportLogEnum: int
{
    use Options, Values,InvokableCases;

    case STARTED = 1;
    case PARTIALLY = 2;
    case FAILED = 3;
    case COMPLETED = 4;
}
