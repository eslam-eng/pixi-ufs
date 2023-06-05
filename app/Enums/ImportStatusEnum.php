<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ImportStatusEnum: int
{
    use Options, Values,InvokableCases;

    case RUNNING = 1;
    case PARTIALLY = 2;
    case FAILED = 3;
    case SUCCESSFUL = 4;
}
