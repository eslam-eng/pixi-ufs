<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ImportTypeEnum: int
{
    use Options, Values,InvokableCases;

    case RECEIVERS = 1;
    case AWBWITHREFERENCE = 2;
    case AWBWITHOUTREFERENCE = 3;
    case PRICE_TABLE = 4;
    case USERS = 5;

}
