<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Departments\DepartmentStoreRequest;
use App\Http\Requests\departments\DepartmentUpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Services\DepartmentService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DepartmentController extends Controller
{
    public function __construct(protected DepartmentService $departmentService)
    {
        $this->middleware('permission:view_departments', ['only' => ['index']]);
        $this->middleware('permission:edit_departments', ['only' => ['edit','update']]);
        $this->middleware('permission:create_departments', ['only' => ['create','store']]);
    }

    /**
     * get all departments
     */
    public function index(Request $request)
    {
        try {
            $filters = array_filter($request->all());
            $departments = $this->departmentService->listing(filters: $filters);
            return DepartmentResource::collection($departments);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    public function create(Request $request)
    {
        $company_id = $request->company_id;
        return view('layouts.dashboard.departments.create', compact('company_id'));
    }

    public function store(DepartmentStoreRequest $request)
    {
        try {
            $departmentDTO = $request->toDepartmentDTO();
            $this->departmentService->store($departmentDTO);
            return redirect()->route('companies.edit', Arr::get($departmentDTO->toArray(), 'company_id'));
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    public function edit(int $id)
    {
        $withRelations = [];
        $department = $this->departmentService->findById(id: $id);
        return view('layouts.dashboard.departments.edit', compact('department'));
    }

    // public function show(int $id)
    // {
    //     $withRelations = [];
    //     $department = $this->departmentService->find(id: $id);
    //     return view('layouts.dashboard.departments.show', compact('department'));
    // }

    public function update(DepartmentUpdateRequest $request, int $id)
    {
        try {
            $departmentDTO = $request->toDepartmentDTO();
            $this->departmentService->update($id, $departmentDTO);
            return redirect()->route('companies.edit', Arr::get($departmentDTO->toArray(), 'company_id'));
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    /**
     * delete existing department
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            $this->departmentService->destroy(id: $id);
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
