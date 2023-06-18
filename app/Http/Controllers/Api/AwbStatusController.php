<?php

namespace App\Http\Controllers\Api;

use App\Enums\AwbStatusCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Awb\AwbStatusResource;
use App\Models\AwbStatus;
use App\Services\AwbHistoryService;
use App\Services\AwbService;
use App\Services\AwbStatusService;
use Illuminate\Http\Request;

class AwbStatusController extends Controller
{
    public function __construct(public AwbStatusService $awbStatusService)
    {
    }


//todo make service to handel awb status crud
    public function index(Request $request)
    {
        try {
            $filter = [];
            if (isset($request->type)){
                $filter['type'] = $request->type;
            }
            $statues = $this->awbStatusService->AwbStatusQueryBuilder(filters: $filter)->get();
            return AwbStatusResource::collection($statues);
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage(), code: 500);
        }
    }

}
