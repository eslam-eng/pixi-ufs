<?php

namespace App\Http\Controllers;

use App\DataTables\CompaniesDatatable;
use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Branches\BranchStoreRequest;
use App\Http\Requests\Branches\BranchUpdateRequest;
use App\Http\Requests\Companies\CompanyStoreRequest;
use App\Http\Requests\Companies\CompanyUpdateRequest;
use App\Http\Resources\Company\CompanyDropDownResource;
use App\Http\Resources\Company\CompanyResource;
use App\Services\BranchService;
use App\Services\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function __construct(protected BranchService $branchService)
    {
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
            return redirect()->back('companies.index');
        } catch (Exception $e) {
            DB::rollBack();
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function edit(int $id)
    {
        $withRelations = [];
        $branch = $this->branchService->find(id: $id);
        return view('layouts.dashboard.branches.edit', compact('branch'));
    }
    
    public function show(int $id)
    {
        $withRelations = [];
        $branch = $this->branchService->find(id: $id);
        return view('layouts.dashboard.branches.show', compact('branch'));
    }

    public function update(BranchUpdateRequest $request, int $id)
    {
        try {
            DB::beginTransaction();
            $branchDTO = $request->toBranchDTO();
            $this->branchService->update($id, $branchDTO);
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
            $this->branchService->destroy(id: $id);
            return redirect()->back();
        }catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

}
