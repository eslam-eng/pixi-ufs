<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Requests\Awb\AwbStoreRequest;
use Illuminate\Http\Request;
use App\Services\AwbService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Awb\AwbHistoryRequest;
use App\Http\Requests\Awb\AwbRescheduleRequest;
use App\Http\Requests\Awb\AwbStatusRequest;
use App\Http\Requests\Awb\AwbStoreAddressAndPhoneRequest;
use App\Http\Requests\Awb\AwbUpdateReceiverPhone;
use App\Http\Resources\Awb\AwbResource;
use App\Services\AwbHistoryService;
use Exception;

class AwbHistoryController extends Controller
{
    public function __construct(private AwbHistoryService $awbHistoryService)
    {
        
    }


    public function awbStatus(AwbHistoryRequest $request, $id)
    {
        try{
            $status = $this->awbHistoryService->awbStatus(id: $id, data: $request->validated());
            if(!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
        
    }
}
