<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Requests\Awb\AwbStoreRequest;
use Illuminate\Http\Request;
use App\Services\AwbService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Awb\AwbCancelRequest;
use App\Http\Requests\Awb\AwbRescheduleRequest;
use App\Http\Requests\Awb\AwbUpdateReceiverPhone;
use App\Http\Resources\Awb\AwbResource;
use Exception;

class AwbController extends Controller
{
    public function __construct(private AwbService $awbService)
    {
    }

    public function index(Request $request)
    {
        try{
            $filters = $request->all();
            $withRelations = [];
            $awbs = $this->awbService->listing($filters, $withRelations);
            return AwbResource::collection($awbs);
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
        
    }

    public function awbDetails(Request $request, $id)
    {
        try{
            $withRelations = ['user', 'latestStatus'];
            $awb = $this->awbService->find(id: $id, relations: $withRelations);
            return apiResponse(data: new AwbResource($awb), message: trans('app.sucess_operation'));
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
    }

    public function cancelAwb(AwbCancelRequest $request, $id)
    {
        try{
            $status = $this->awbService->cancelAwb(id: $id, data: $request->validated());
            if(!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
        
    }

    public function awbReschedule(AwbRescheduleRequest $request, $id)
    {
        try{
            $status = $this->awbService->awbReschedule(id: $id, data: $request->validated());
            if(!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));    
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
    }
    public function updateReceiverPhone(AwbUpdateReceiverPhone $request, $id)
    {
        try{
            $status = $this->awbService->updateReceiverPhone(id: $id, data: $request->validated());
            if(!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));    
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
    }

    public function create()
    {
        return view('layouts.dashboard.awb.create');
    }

    public function store(AwbStoreRequest $request)
    {


    }

}
