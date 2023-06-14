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
use App\Services\LocationsService;
use Exception;
use Illuminate\Database\QueryException;
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
        $cities = app()->make(LocationsService::class)->getAll(filters: ['depth' => 1]);
        return view('layouts.dashboard.companies.create', compact('cities'));
    }

    public function store(CompanyStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $companyDTO = $request->toCompanyDTO();
            $this->companyService->store($companyDTO);
            DB::commit();
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.receiver_created_successfully')
            ];
            return back()->with('toast',$toast);
        } catch (Exception $e) {
            DB::rollBack();
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.receiver_created_successfully')
            ];
            return back()->with('toast',$toast);
        }
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
        try{
            $withRelations = ['branches', 'departments'];
            $company = $this->companyService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.companies.edit', compact('company'));
        }catch(Exception $e){
            return redirect()->back();
        }
    }

    public function show(int $id)
    {
        try {
            $withRelations = [];
            $company = $this->companyService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.companies.show', compact('company'));
        }catch (Exception $e) {
            DB::rollBack();
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function update(CompanyUpdateRequest $request, int $id)
    {
        try {
            DB::beginTransaction();
            $companyDTO = $request->toCompanyDTO();
            $this->companyService->update($id, $companyDTO);
            DB::commit();
            return redirect()->route('companies.index');
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
        }catch (QueryException $e) {
            // Exception was thrown, do something to handle the error
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return apiResponse(message: "cannot deleted related to another records", code: 500);
            }
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

}
