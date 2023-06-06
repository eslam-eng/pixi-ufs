<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Awb\AwbStoreRequest;
use Illuminate\Http\Request;
use App\Services\AwbService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Awb\AwbResource;
use App\Http\Resources\Awb\AwbStatisticsResource;
use App\Http\Resources\AwbStatusResource;
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
            $awbs = $this->awbService->listing($filters, $withRelations, $request->limit ?? 3);
            return AwbResource::collection($awbs);
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
        
    }

    public function awbDetails($id)
    {
        try{
            $withRelations = ['user', 'latestStatus'];
            $awb = $this->awbService->find(id: $id, relations: $withRelations);
            return apiResponse(data: new AwbResource($awb), message: trans('app.sucess_operation'));
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
    }

    public function lastStatus($id)
    {
        try{
            $data = $this->awbService->lastStatus(id: $id);
            if(!$data)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(data: new AwbStatusResource($data), message: trans('app.success_operation'));
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
        
    }

    public function statistics()
    {
        try{
            $withRelations = ['latestStatus'];
            $data = $this->awbService->listing(filters: [], withRelations: $withRelations);
            if(!$data)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(data: new AwbStatisticsResource($data), message: trans('app.success_operation'));
        }catch(Exception $e){
            return apiResponse( message: $e->getMessage(), code: 422);
        }
        
    }
}
