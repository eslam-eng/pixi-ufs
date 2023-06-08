<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Departments\DepartmentStoreRequest;
use App\Http\Requests\departments\DepartmentUpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Services\DepartmentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DepartmentController extends Controller
{
    public function __construct(protected DepartmentService $departmentService)
    {
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
        $department = $this->departmentService->find(id: $id);
        return view('layouts.dashboard.departments.edit', compact('department'));
    }

    public function show(int $id)
    {
        $withRelations = [];
        $department = $this->departmentService->find(id: $id);
        return view('layouts.dashboard.departments.show', compact('department'));
    }

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
            return redirect()->back();
        }catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }
}
