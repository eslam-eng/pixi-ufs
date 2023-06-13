<?php

namespace App\Http\Controllers;

use App\DataTables\ImportLogsDatatable;
use App\Services\ImportLogsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\LazyCollection;

class ImportLogsController extends Controller
{

    public function __construct(private ImportLogsService $importLogsService)
    {
        
    }
    /**
     * get all addresses
     * @param Request $request
     */
    public function index(ImportLogsDatatable $datatable, Request $request)
    {
        $filters = array_filter($request->get('filters', []));
        $withRelations = ['user:id,name,company_id,branch_id,department_id','user.branch:id,name','user.department:id,name'];
        return $datatable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.Imports.index');

    }

    public function showErrors(int $id)
    {
        try{
            $data = $this->importLogsService->findById($id, ['errors']);
            $errors = LazyCollection::make($data->errors);
            $response =  view('layouts.dashboard.Imports.components.errors',compact('errors'))->render();
            return apiResponse(data: $response, message: trans('app.success_operation'));
        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }
}
