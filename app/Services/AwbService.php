<?php

namespace App\Services;

use App\DTO\Awb\AwbDTO;
use App\Models\Awb;

class AwbService extends BaseService
{

    public function __construct(public Awb $model)
    {
    }

    public function store(AwbDTO $awbDTO)
    {
        //Store main awb data
        $awbDTO->zone_price = 20;
        $awbDTO->additional_kg_price = 10 ;


    }

}
