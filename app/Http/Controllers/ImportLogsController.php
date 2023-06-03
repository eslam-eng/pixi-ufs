<?php

namespace App\Http\Controllers;

use App\DataTables\ImportLogsDatatable;
use Illuminate\Http\Request;

class ImportLogsController extends Controller
{

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
}
