<?php

namespace App\Http\Controllers\Api;

use App\Enums\AwbStatuses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Awb\AwbChangeStatusRequest;
use App\Http\Requests\Awb\AwbPodRequest;
use App\Http\Resources\Awb\AwbDetailsResource;
use App\Http\Resources\Awb\AwbResource;
use App\Services\AwbService;
use Exception;
use Illuminate\Http\Request;

class AwbController extends Controller
{
    public function __construct(private AwbService $awbService)
    {
    }

    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $filters['status'] = $request->get('status',AwbStatuses::CREATE_SHIPMENT());
            $withRelations = ['receiverCity', 'receiverArea'];
            $awbs = $this->awbService->listing($filters, $withRelations, $request->perPage ?? 5);
            return AwbResource::collection($awbs);
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function awbDetails($id)
    {
        try {
            $withRelations = ['company:id,name','latestStatus.status'];
            $awb = $this->awbService->findById(id: $id, withRelations: $withRelations);
            return apiResponse(data: new AwbDetailsResource($awb), message: trans('app.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function status(int $id , AwbChangeStatusRequest $request)
    {
        try {
            $status = $this->awbService->status(id: $id, awb_status_data: $request->validated());
            if (!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function pod(int $id, AwbPodRequest $request)
    {
        try {
            $status = $this->awbService->pod(id: $id, data: $request->validated());
            if (!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

}
