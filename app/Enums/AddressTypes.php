<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum AddressTypes: int
{
    use Options, Values, InvokableCases;

    case RECEIVER = 1;
    case COMPANY = 2;
    case BRANCH = 3;
}
