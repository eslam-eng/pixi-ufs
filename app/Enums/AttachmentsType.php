<?php

namespace App\Enums;

use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum AttachmentsType: int
{
    use Options, Values;

    case PRIMARYIMAGE = 1;
    case ATTACHMENT = 2;
}
