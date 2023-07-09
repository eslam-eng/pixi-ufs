<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum AwbStatuses: int
{
    use Options, Values, InvokableCases;
//    codes for awb status
    case CREATE_SHIPMENT = 1;
    case CALLING_RECEIVER = 9 ;
    case DELIVERED = 10;
    case CANCELED = 11;

}
