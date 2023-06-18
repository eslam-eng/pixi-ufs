<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Awb\AwbChangeStatusRequest;
use App\Services\AwbHistoryService;
use App\Services\AwbService;
use Exception;

class AwbHistoryController extends Controller
{
    public function __construct(private AwbHistoryService $awbHistoryService,public AwbService $awbService)
    {

    }


    public function changeStatus(AwbChangeStatusRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $awb = $this->awbService->findById(id: $id);
            $this->awbHistoryService->changeStatus($awb ,$data);
            return apiResponse(message: trans('app.success_operation'));
        }catch (\Exception $exception)
        {
            return apiResponse(message: $exception->getMessage(),code: 500);
        }
    }
}
