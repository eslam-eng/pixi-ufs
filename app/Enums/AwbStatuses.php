<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum AwbStatuses: int
{
    use Options, Values, InvokableCases;

    case PREPARE = 1;
    case DELIVERED = 2;
    case RETURN_PAID = 3;
    case RETURN_WITHOUT_PAID = 4;
    case CLOSED = 5;
    case OUT_FOR_DELIVERY = 6;
    case COLLECTED = 7;
    case PAID_TO_CUSTOMER = 8;

}
