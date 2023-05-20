<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Branches\BranchStoreRequest;
use App\Http\Requests\Api\Branches\BranchUpdateRequest;
use App\Http\Resources\BranchResource;
use App\Services\BranchService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function __construct(private BranchService $branchService)
    {

    }

    /**
     * get all branches
     */
    public function index(Request $request)
    {
        try {
            $filters = array_filter($request->all());
            $withRelations = ['company:id,name','addresses'=>fn($query)=>$query->with(['city','area'])];
            $branches = $this->branchService->listing(filters: $filters, withRelations: $withRelations);
            return BranchResource::collection($branches);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: $e->getCode());
        }
    }

    public function store(BranchStoreRequest $request)
    {
        try {
            DB::beginTransaction();
                $branchDto = $request->toBranchDTO();
                $this->branchService->store($branchDto);
            DB::commit();
            return apiResponse(message: trans('lang.success_operation'));
        } catch (Exception $e) {
            DB::rollBack();
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    public function edit(int $id)
    {
        try {
            $branch = $this->branchService->findById(id: $id,withRelations: ['company','addresses']);
            return  BranchResource::make($branch);
        }catch (NotFoundException $exception){
            return apiResponse(message: $exception->getMessage(), code: 422);
        }catch (Exception $exception){
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);

        }
    }

    public function update(BranchUpdateRequest $request, int $id)
    {
        try {
            DB::beginTransaction();
            $branchDto = $request->toBranchDTO();
            $this->branchService->update($id, $branchDto);
            DB::commit();
            return apiResponse(message: trans('lang.success_operation'));
        } catch (Exception|NotFoundException $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    /**
     * delete existing branch
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            $this->branchService->destroy(id: $id);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }
}
