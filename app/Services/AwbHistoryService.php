<?php

namespace App\Services;

use App\Models\Awb;
use App\Models\AwbHistory;

class AwbHistoryService extends BaseService
{

    public function __construct(public AwbHistory $model)
    {
    }


}
