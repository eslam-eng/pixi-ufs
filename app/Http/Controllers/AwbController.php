<?php

namespace App\Http\Controllers;

use App\DataTables\AwbsDataTable;
use App\DTO\Awb\AwbDTO;
use App\Enums\ImportationTypes;
use App\Http\Requests\Awb\AwbStoreRequest;
use App\Services\AwbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AwbController extends Controller
{
    public function __construct(public AwbService $awbService)
    {
    }

//    public function index(Request $request)
//    {
//        $paginate = $request->paginate ?? 10 ;
//        $filters = array_filter($request->get('filters', []));
//        $withRelations = ['department:id,name', 'branch:id,name','company:id,name', 'additionalInfo'];
//        $awbs =  $this->awbService->queryGet(filters: $filters , withRelations: $withRelations)->paginate($paginate);
//        return view('layouts.dashboard.awb.index',['awbs'=>$awbs]);
//    }

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

    public function destroy(Request $request)
    {
        try {
            $this->awbService->delete($request->id);
            return apiResponse(message: 'deleted successfully');
        }catch (\Exception $exception)
        {
            return apiResponse(message: $exception->getMessage(),code: 500);
        }

    }

    public function deleteMultiple(Request $request)
    {
        try {
            $this->awbService->deleteMultiple($request->ids);
            return apiResponse(message: 'deleted successfully');
        }catch (\Exception $exception)
        {
            return apiResponse(message: $exception->getMessage(),code: 500);
        }

    }

    public function importForm()
    {
        return view('layouts.dashboard.awb.components.importation.form');
    }

    public function downloadTemplate()
    {
        $user = auth()->user()->load('company:id,name,importation_type');
        $importation_type = $user->company?->importation_type ?? ImportationTypes::WITHOUTREFERENCE ;

//        $filters = [];
//        if ($importation_type == )
//            $filters['company_id'] = 1;
        $branches = $this->branchService->getAll(filters: $filters);
        ob_end_clean();
        ob_start();
        return $excel->download(new ReceiversExport($branches), 'receivers' . time() . '.xlsx');

    }

}
