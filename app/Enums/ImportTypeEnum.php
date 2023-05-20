<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ImportTypeEnum: int
{
    use Options, Values,InvokableCases;

    case RECEIVERS = 1;
    case AWB = 2;

}
