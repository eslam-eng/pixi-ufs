<?php

namespace App\Http\Controllers;

use App\DataTables\AwbsDataTable;
use App\DTO\Awb\AwbDTO;
use App\DTO\Awb\AwbImportDTO;
use App\Enums\ImportTypeEnum;
use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Exports\AwbsWithoutReferenceExport;
use App\Exports\AwbsWithReferenceExport;
use App\Http\Requests\Awb\AwbBulkChangeStatusRequest;
use App\Http\Requests\Awb\AwbFileUploadExcelRequest;
use App\Http\Requests\Awb\AwbStoreRequest;
use App\Imports\Awbs\AwbsImport;
use App\Imports\Awbs\AwbsSyncByReferenceImport;
use App\Models\AwbStatus;
use App\Services\AwbHistoryService;
use App\Services\AwbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class AwbController extends Controller
{
    public function __construct(public AwbService $awbService)
    {
    }

    public function index(AwbsDataTable $dataTable, Request $request)
    {
        $user = auth()->user();
        $filters = array_filter($request->get('filters', []));
        if ($user->type != UsersType::SUPERADMIN())
            $filters['company_id'] = $user->company_id;
        if ($user->type == UsersType::EMPLOYEE())
            $filters['branch_id'] = $user->branch_id;
        $withRelations = ['branch:id,name', 'company:id,name','department:id,name', 'user:id,name', 'latestStatus.status'];
        $awb_statuses = AwbStatus::all();
        return $dataTable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.awb.index',compact('awb_statuses'));
    }

    public function create()
    {
        return view('layouts.dashboard.awb.create');
    }

    public function show(int $id)
    {
        try {
            $user = auth()->user();

            $withRelations = [
                'company:id,name', 'branch:id,name', 'department:id,name','receiverCity','receiverArea',
                'additionalInfo','history'=>fn($query)=>$query->orderByDesc('id')->with('status')
            ];

            $awb = $this->awbService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.awb.show', ['awb' => $awb, 'user' => $user]);
        } catch (NotFoundException $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $exception->getMessage()
            ];
            return to_route('awbs.index')->with('toast', $toast);
        }
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
                'message' => "$awb->code " . trans('app.aw_created_successfully')
            ];
            DB::commit();
            return to_route('awbs.index')->with('toast', $toast);
        } catch (\Exception $exception) {
            DB::rollBack();
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            DB::commit();
            return back()->with('toast', $toast);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->awbService->delete($id);
            return apiResponse(message: 'deleted successfully');
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage(), code: 500);
        }

    }

    public function deleteMultiple(Request $request)
    {
        try {
            $this->awbService->deleteMultiple($request->ids);
            return apiResponse(message: 'deleted successfully');
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage(), code: 500);
        }

    }

    public function importForm()
    {
        $company_id = auth()->user()->company_id;
        return view('layouts.dashboard.awb.components.importation.form', ['company_id' => $company_id]);
    }

    public function downloadTemplate(Excel $excel)
    {
        $user = auth()->user()->load('company:id,name,importation_type');
        $importation_type = $user->company?->importation_type ?? ImportTypeEnum::AWBWITHOUTREFERENCE;
        ob_start();
        ob_end_clean();
        if ($importation_type == ImportTypeEnum::AWBWITHOUTREFERENCE())
            return $excel->download(new AwbsWithoutReferenceExport(), 'awbs_without_reference_' . time() . '.xlsx');
        else
            return $excel->download(new AwbsWithReferenceExport(), 'awbs_with_reference_' . time() . '.xlsx');

    }

    public function import(AwbFileUploadExcelRequest $request)
    {
        $user = auth()->user()->load('company:id,name,importation_type', 'branch:id,name,city_id,area_id');
        $importation_type = $user->company?->importation_type;

        $awbImportDTO = AwbImportDTO::fromRequest($request);

        try {
            DB::beginTransaction();
            if ($importation_type == ImportTypeEnum::AWBWITHOUTREFERENCE())
                $importObject = new AwbsImport(
                    creator: $user,
                    service_type_id: $awbImportDTO->service_type_id,
                    shipment_type_id: $awbImportDTO->shipment_type_id,
                    payment_type: $awbImportDTO->payment_type,
                    importation_type: $importation_type,
                );
            else if ($importation_type == ImportTypeEnum::AWBWITHREFERENCE())
                $importObject = new AwbsSyncByReferenceImport(
                    creator: $user,
                    service_type_id: $awbImportDTO->service_type_id,
                    shipment_type_id: $awbImportDTO->shipment_type_id,
                    payment_type: $awbImportDTO->payment_type,
                    importation_type: $importation_type,
                );
            else
                throw new NotFoundException(trans('app.invalid_importation_type'));
            $importObject->import($awbImportDTO->file)->onQueue($importObject->getQueueName());
            DB::commit();
            $toast = ['title' => 'success', 'message' => trans('admin.imports.sheet_queued_check_from_import')];
            return to_route('import-logs.index')->with('toast', $toast);

        } catch (NotFoundException $exception) {
            DB::rollBack();
            $toast = ['type' => 'error', 'title' => 'error', 'message' => $exception->getMessage()];
            return back()->with('toast', $toast);
        } catch (\Exception $exception) {
            DB::rollBack();
            $toast = ['type' => 'error', 'title' => 'error', 'message' => "there is an error in excel file"];
            return back()->with('toast', $toast);
        }
    }

    public function printThreeInOnePage(Request $request)
    {
        try {
            $awbs_ids = $request->ids;
            $awbs_ids = json_decode($awbs_ids);
            $is_print_duplicated = $request->boolean('is_duplicated') ?? false;
            if (count($awbs_ids)) {
                $withRelations = [
                    'company:id,name',
                    'department:id,name',
                    'branch:id,name,city_id,area_id',
                    'branch.city',
                    'branch.area',
                    'additionalInfo'
                ];
                $awbs = $this->awbService->queryGet(filters: ['ids' => $awbs_ids], withRelations: $withRelations)->get();
                return  view('layouts.dashboard.awb.print.print-awb-three-in-one-page', ['awbs' => $awbs, 'is_print_duplicated' => $is_print_duplicated]);

            } else {
                return apiResponse(message: "please select at least one for print",code: 422);
            }
            return apiResponse(data: $awbs_rendered);
        } catch (\Exception $exception) {
            $toast = ['type' => 'error', 'title' => 'error', 'message' => "there is an error"];
            return back()->with('toast', $toast);
        }
    }

    public function changeStatusForMultipleAwbs(AwbBulkChangeStatusRequest $request,AwbHistoryService $awbHistoryService)
    {
        try {
            $result = $awbHistoryService->changeMultipleAwbStatus(status: $request->status,awb_ids: $request->ids);
            if ($result)
                return apiResponse(message: trans('app.awbs_status_changed_successfully'));
            else
                return apiResponse(message: trans('app.there_is_an_error_in_change_awbs_status'));
        }catch (\Exception $exception)
        {
            return apiResponse(message: $exception->getMessage(),code: 500);
        }
    }
}
