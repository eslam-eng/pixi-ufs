<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Departments\DepartmentStoreRequest;
use App\Http\Requests\Api\Departments\DepartmentUpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Services\DepartmentService;
use Exception;
use Illuminate\Http\Request;

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

    public function store(DepartmentStoreRequest $request)
    {
        try {
            $this->departmentService->store($request->toDepartmentDTO());
            return apiResponse(message: trans('lang.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    public function update(DepartmentUpdateRequest $request, int $id)
    {
        try {
            $departmentDTO = $request->toDepartmentDTO();
            $this->departmentService->update($id, $departmentDTO);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (Exception|NotFoundException $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
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
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }
}
