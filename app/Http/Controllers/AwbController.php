<?php

namespace App\Http\Controllers;

use App\DataTables\AwbsDataTable;
use App\DTO\Awb\AwbDTO;
use App\Http\Requests\Awb\AwbStoreRequest;
use App\Services\AwbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AwbController extends Controller
{
    public function __construct(public AwbService $awbService)
    {
    }

    public function index(AwbsDataTable $dataTable, Request $request)
    {
        $filters = array_filter($request->get('filters', []));
        $withRelations = ['department:id,name', 'branch:id,name,company_id,address', 'branch.company:id,name', 'user:id,name', 'additionalInfo'];
        return $dataTable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.awb.index');
    }

    public function create()
    {
        return view('layouts.dashboard.awb.create');
    }

    public function store(AwbStoreRequest $request)
    {
        try {
            $awbDTO = AwbDTO::fromRequest($request);
            DB::beginTransaction();
            //logic
            $awb = $this->awbService->store($awbDTO);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' =>"$awb->code" .  trans('app.aw_created_successfully')
            ];
            DB::commit();
            return to_route('awb.index')->with('toast',$toast);
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }


    }

}
