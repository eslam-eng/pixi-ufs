<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Awb\AwbChangeStatusRequest;
use App\Http\Resources\Awb\AwbStatusResource;
use App\Models\AwbStatus;
use App\Services\AwbHistoryService;
use App\Services\AwbService;

class AwbStatusController extends Controller
{
    public function __construct(private AwbHistoryService $awbHistoryService,public AwbService $awbService)
    {

    }


//todo make service to handel awb status crud
    public function index()
    {
        try {
            $statues = AwbStatus::all();
            return AwbStatusResource::collection($statues);
        }catch (\Exception $exception)
        {
            return apiResponse(message: $exception->getMessage(),code: 500);
        }
    }
}
