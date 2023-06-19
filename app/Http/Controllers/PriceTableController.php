<?php

namespace App\Http\Controllers;

use App\DataTables\PriceTableDataTable;
use App\Enums\ImportTypeEnum;
use App\Exceptions\NotFoundException;
use App\Exports\PriceTableExport;
use App\Http\Requests\PriceTable\ImportPricesRequest;
use App\Http\Requests\PriceTable\IncreaseCompanyPriceRequest;
use App\Http\Requests\PriceTable\PriceTableStoreRequest;
use App\Http\Requests\PriceTable\PriceTableUpdateRequest;
use App\Imports\PriceTable\PricesImport;
use App\Services\PriceTableService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class PriceTableController extends Controller
{
    public function __construct(protected PriceTableService $priceTableService)
    {
        $this->middleware(['permission:view_price_tables|edit_price_tables|create_price_tables']);
    }

    /**
     * get all receivers
     */
    public function index(PriceTableDataTable $priceTableDataTable, Request $request)
    {
        try {
            $filters = array_filter($request->get('filters', []), function ($value) {
                return ($value !== null && $value !== false && $value !== '');
            });
            $withRelations = ['locationFrom', 'locationTo', 'company:id,name'];
            return $priceTableDataTable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.price-table.index');
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    public function create()
    {
        return view('layouts.dashboard.price-table.create');
    }

    public function store(PriceTableStoreRequest $request)
    {
        try {
            $priceTableDto = $request->toPriceTableDTO();
            $this->priceTableService->store($priceTableDto);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.price_created_successfully')
            ];
            return redirect()->route('prices.index')->with('toast', $toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }


    public function edit(int $id)
    {
        try {
            $withRelations = ['company:id,name', 'locationFrom', 'locationTo'];
            $priceTable = $this->priceTableService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.price-table.edit', ['priceTable' => $priceTable]);
        } catch (Exception|NotFoundException $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    public function increaseCompanyPriceForm()
    {
        return view('layouts.dashboard.price-table.increase-company-price');
    }

    public function increasePrice(IncreaseCompanyPriceRequest $request)
    {
        try {
            $this->priceTableService->increaseCompanyPrice(company_id: $request->company_id, increase_percentage: $request->increase_percentage);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => "prices updated Successfully"
            ];
            return to_route('prices.index')->with('toast', $toast);
        } catch (Exception $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    public function update(PriceTableUpdateRequest $request, int $id)
    {
        try {
            $priceTableDto = $request->toPriceTableDTO();
            $this->priceTableService->update($id, $priceTableDto);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.success_operation')
            ];
            return redirect()->route('prices.index')->with('toast', $toast);
        } catch (Exception|NotFoundException $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
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
        return view('layouts.dashboard.price-table.importation.form');
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function downloadPriceTableTemplate(Excel $excel)
    {
        return $excel->download(new PriceTableExport(), 'prices' . time() . '.xlsx');
    }

    public function import(ImportPricesRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = getAuthUser();
            $importation_type = ImportTypeEnum::PRICE_TABLE->value;
            $company_id = $request->company_id ;
            $file = $request->file('file');
            $importObject = new PricesImport(creator: $user, importation_type: $importation_type,company_id: $company_id);
            $importObject->import($file)->onQueue('default');
            DB::commit();
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.import_success_message')
            ];
            return to_route('import-logs.index')->with('toast', $toast);
        } catch (Exception $exception) {
            DB::rollBack();
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

}
