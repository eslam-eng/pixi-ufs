<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\Branches\BranchStoreRequest;
use App\Http\Requests\Branches\BranchUpdateRequest;
use App\Services\BranchService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function __construct(protected BranchService $branchService)
    {
        $this->middleware('permission:view_branches', ['only' => ['index']]);
        $this->middleware('permission:edit_branches', ['only' => ['edit', 'update']]);
        $this->middleware('permission:create_branches', ['only' => ['create', 'store']]);
    }

    public function create(Request $request)
    {
        $company_id = $request->company_id;
        return view('layouts.dashboard.branches.create', compact('company_id'));
    }

    public function store(BranchStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $branchDTO = $request->toBranchDTO();
            $this->branchService->store($branchDTO);
            DB::commit();
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.success_operation')
            ];
            return to_route('companies.edit', Arr::get($branchDTO->toArray(), 'company_id'))->with('toast', $toast);
        } catch (Exception $e) {
            DB::rollBack();
            $toast = [
                'type' => 'error',
                'title' => 'success',
                'message' => trans('app.failed_operation')
            ];
            return to_route('companies.edit', Arr::get($branchDTO->toArray(), 'company_id'))->with('toast', $toast);
        }
    }

    public function edit(int $id)
    {
        try {
            $branch = $this->branchService->findById(id: $id);
            return view('layouts.dashboard.branches.edit', compact('branch'));
        } catch (Exception $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'success',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast', $toast);
        }

    }

    // public function show(int $id)
    // {
    //     $withRelations = [];
    //     $branch = $this->branchService->find(id: $id);
    //     return view('layouts.dashboard.branches.show', compact('branch'));
    // }

    public function update(BranchUpdateRequest $request, int $id)
    {
        try {
            DB::beginTransaction();
            $branchDTO = $request->toBranchDTO();
            $this->branchService->update($id, $branchDTO);
            DB::commit();
            return redirect()->route('companies.edit', $request->company_id);
        } catch (Exception $e) {
            DB::rollBack();
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->branchService->destroy(id: $id);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (QueryException $e) {
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
