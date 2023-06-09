<?php

namespace App\Http\Controllers;

use App\Services\AwbService;

class AwbHistoryController extends Controller
{

    public function __construct(public AwbService $awbService)
    {
    }

    public function create(int $awb_id)
    {
        try {
            $withRelations = [
                'company:id,name', 'branch:id,name', 'department:id,name',
                'history' => fn($query) => $query->orderByDesc('id')->with('status')
            ];
            $awb = $this->awbService->findById(id: $awb_id, withRelations: $withRelations);
            return view('layouts.dashboard.awb.history.form', ['awb' => $awb]);
        } catch (\Exception $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $exception->getMessage()
            ];
            return to_route('awbs.index')->with('toast', $toast);
        }
    }

    public function store()
    {

    }
}
