<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GeneralException;
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
            $expects_json = false ;
            $data = $request->validated();
            $awb = $this->awbService->findById(id: $id);
            if (request()->expectsJson())
                $expects_json = true ;
            $this->awbHistoryService->changeStatus($awb ,$data,$expects_json);
            return apiResponse(message: trans('app.success_operation'));
        }catch (GeneralException $exception){
            return apiResponse(message: $exception->getMessage(),code: 500);
        }
        catch (\Exception $exception)
        {
            return apiResponse(message:'there is an error please try again later',code: 500);
        }
    }
}
