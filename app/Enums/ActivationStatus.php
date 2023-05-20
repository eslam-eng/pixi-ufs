<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ActivationStatus: int
{
    use Options, Values,InvokableCases;

    case ACTIVE = 1;
    case INACTIVE = 0;
}
