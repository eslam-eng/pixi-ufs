<?php

namespace App\Http\Controllers;

use App\DataTables\CompaniesDatatable;
use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyStoreRequest;
use App\Http\Requests\Companies\CompanyUpdateRequest;
use App\Http\Resources\Company\CompanyDropDownResource;
use App\Http\Resources\Company\CompanyResource;
use App\Services\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function __construct(protected CompanyService $companyService)
    {
    }

    public function index(CompaniesDatatable $companiesDatatable, Request $request)
    {
        try {
            $filters = array_filter($request->all());
            $withRelations = [];
            return $companiesDatatable->with(['filters'=>$filters,'withRelations'=>$withRelations])->render('layouts.dashboard.companies.index');
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: $e->getCode());
        }
    }

    public function create()
    {
        return view('layouts.dashboard.companies.create');
    }

    public function store(CompanyStoreRequest $request)
    {
        // return $request->all();
        // try {
            DB::beginTransaction();
            $companyDTO = $request->toCompanyDTO();
            $this->companyService->store($companyDTO);
            DB::commit();
            return redirect()->route('companies.index');
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     return apiResponse(message: $e->getMessage(), code: 422);
        // }
    }

    public function getCompaniesForDropDown()
    {
        $filters = [];
        $auth_user = getAuthUser();
        if ($auth_user->type != UsersType::SUPERADMIN)
            $filters['id'] = $auth_user->id ;
        $companies =  $this->companyService->getCompaniesForSelectDropDown($filters);
        return CompanyDropDownResource::collection($companies);
    }

    public function edit(int $id)
    {
        $withRelations = [];
        $company = $this->companyService->findById(id: $id, withRelations: $withRelations);
        return view('layouts.dashboard.companies.edit', compact('company'));
    }
    
    public function show(int $id)
    {
        $withRelations = [];
        $company = $this->companyService->findById(id: $id, withRelations: $withRelations);
        return view('layouts.dashboard.companies.show', compact('company'));
    }

    public function update(CompanyUpdateRequest $request, int $id)
    {
        try {
            DB::beginTransaction();
            $companyDTO = $request->toCompanyDTO();
            $this->companyService->update($id, $companyDTO);
            DB::commit();
            return redirect()->route('branches.create');
        }catch (Exception $e) {
            DB::rollBack();
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->companyService->destroy(id: $id);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

}
