<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Awb\AwbStoreRequest;
use Illuminate\Http\Request;
use App\Services\AwbService;
use App\Http\Controllers\Controller;
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

}
