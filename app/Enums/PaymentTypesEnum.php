<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum PaymentTypesEnum: int
{
    use Options, Values,InvokableCases;
    case ACCOUNT = 1;
    case PREPAID = 2;
    case CASH = 3 ;
    case COLLECTION = 4 ;
}
