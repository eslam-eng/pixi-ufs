<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum Stepper: int
{
    use Options, Values,InvokableCases;

    case INCOMPANY = 1;
    case PROCESSING = 2;
    case HOLD = 3;
    case DELIVERED = 4;
}
