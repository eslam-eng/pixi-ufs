<?php

namespace App\Http\Controllers;

use App\Http\Requests\Awb\AwbChangeStatusRequest;
use App\Models\AwbStatus;
use App\Services\AwbHistoryService;
use App\Services\AwbService;

class AwbHistoryController extends Controller
{

    public function __construct(public AwbService $awbService,public AwbHistoryService $awbHistoryService)
    {
    }

    public function create(int $awb_id)
    {
        try {
            $withRelations = [
                'company:id,name', 'branch:id,name', 'department:id,name',
                'history' => fn($query) => $query->orderByDesc('id')->with('status')
            ];
            $awb_statuses = AwbStatus::all(['id','name','code']);
            $awb = $this->awbService->findById(id: $awb_id, withRelations: $withRelations);
            return view('layouts.dashboard.awb.history.create', ['awb' => $awb,'statuses'=>$awb_statuses]);
        } catch (\Exception $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $exception->getMessage()
            ];
            return to_route('awbs.index')->with('toast', $toast);
        }
    }

    public function awbHistoryGallary(int $awbHistoryId)
    {
        try {
            $withRelations = ['attachments'];
            $model = $this->awbHistoryService->findById(id: $awbHistoryId, withRelations: $withRelations);
            return view('layouts.dashboard.awb.history.awb-gallary', ['model' => $model]);
        } catch (\Exception $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $exception->getMessage()
            ];
            return to_route('awbs.index')->with('toast', $toast);
        }
    }

    public function store(int $awb_id , AwbChangeStatusRequest $request)
    {
        try {
            $data = $request->validated();
            $awb = $this->awbService->findById(id: $awb_id);
            $this->awbHistoryService->changeStatus($awb ,$data);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' =>"status Changed Successfully"
            ];
            return back()->with('toast', $toast);
        }catch (\Exception $exception)
        {
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }
}
