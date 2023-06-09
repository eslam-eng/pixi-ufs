<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum UsersType: int
{
    use Options, Values, InvokableCases;

    case SUPERADMIN = 1;
    case ADMIN = 2;
    case EMPLOYEE = 3;
    case COURIER = 4;
}
