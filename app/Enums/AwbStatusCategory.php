<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum AwbStatusCategory: int
{
    use Options, Values,InvokableCases;

    case AWB = 1;
    case PICKUP = 2;
    case CANCEL_REASON = 3;

}
