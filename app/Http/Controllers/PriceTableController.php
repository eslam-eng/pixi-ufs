<?php

namespace App\Http\Controllers;

use App\DataTables\PriceTableDataTable;
use App\DataTables\ReceiversDatatable;
use App\DTO\PriceTable\PriceTableDTO;
use App\DTO\Receiver\ReceiverDTO;
use App\Enums\ImportTypeEnum;
use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Exports\ReceiversExport;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\PriceTable\PriceTableStoreRequest;
use App\Http\Requests\PriceTable\PriceTableUpdateRequest;
use App\Http\Requests\Receivers\ReceiverStoreRequest;
use App\Http\Requests\Receivers\ReceiverUpdateRequest;
use App\Http\Resources\Receiver\ReceiverEditResource;
use App\Imports\Receivers\ReceiversImport;
use App\Services\BranchService;
use App\Services\PriceTableService;
use App\Services\ReceiverService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class PriceTableController extends Controller
{
    public function __construct(protected PriceTableService $priceTableService)
    {

    }

    /**
     * get all receivers
     */
    public function index(PriceTableDataTable $priceTableDataTable , Request $request)
    {
        try {
            $user = auth()->user();
            $filters = array_filter($request->get('filters',[]));
            if ($user->type != UsersType::SUPERADMIN())
                $filters['company_id'] = $user->company_id ;
            $withRelations = ['city','area','company:id,name'];
            return $priceTableDataTable->with(['filters'=>$filters,'withRelations'=>$withRelations])->render('layouts.dashboard.price-table.index');
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }

    public function create()
    {
        return view('layouts.dashboard.price-table.create');
    }

    public function store(PriceTableStoreRequest $request)
    {
        try {
            $priceTableDto = PriceTableDTO::fromRequest($request);
            $this->priceTableService->store($priceTableDto);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.price_created_successfully')
            ];
            return back()->with('toast',$toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }


    public function edit(int $id)
    {
        try {
            $withRelations = ['company:id,name','city', 'area'];
            $priceTable = $this->priceTableService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.price-table.edit',['priceTable'=>$priceTable]);
        } catch (Exception|NotFoundException $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }

     public function update(PriceTableUpdateRequest $request, int $id)
    {
        try {
            $priceTableDto = ReceiverDTO::fromRequest($request);
            $this->priceTableService->update($id, $priceTableDto);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (Exception|NotFoundException $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    /**
     * delete existing receiver
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            $this->priceTableService->destroy(id: $id);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    public function importForm()
    {
        return view('layouts.dashboard.receivers.importation.form');
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function downloadPriceTableTemplate(Excel $excel)
    {
        $user = getAuthUser();
        $filters = [];
        if ($user->type == UsersType::ADMIN())
            $filters['company_id'] = $user->company_id;
        if ($user->type == UsersType::EMPLOYEE)
            $filters['id'] = $user->branch_id ;
        $withRelations = ['company:id,name'];
        $branches = $this->branchService->getAll(filters: $filters,withRelations: $withRelations);
        return $excel->download(new ReceiversExport($branches), 'receivers' . time() . '.xlsx');
    }

    public function import(FileUploadRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = getAuthUser();
            $importation_type = ImportTypeEnum::RECEIVERS;
            $file = $request->file('file');
            $importObject = new ReceiversImport( creator: $user,importation_type: $importation_type);
            $importObject->import($file)->onQueue('default');
            DB::commit();
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.import_success_message')
            ];
            return to_route('import-logs.index')->with('toast',$toast);
        }catch (Exception $exception)
        {
            DB::rollBack();
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }

}
