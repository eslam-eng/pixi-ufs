<?php

namespace App\Services;

use App\DTO\Branch\BranchDTO;
use App\DTO\Company\CompanyDTO;
use App\Exceptions\NotFoundException;
use App\Models\Company;
use App\QueryFilters\CompaniesFilter;
use Illuminate\Database\Eloquent\Builder;


class CompanyService extends BaseService
{

    public function __construct(public Company $model, private BranchService $branchService)
    {
    }

    public function getModel(): Company
    {
        return $this->model ;
    }

    public function queryGet(array $filters = [],array $withRelations = []): builder
    {
        $result = $this->model->query()->with($withRelations);
        return $result->filter(new CompaniesFilter($filters));
    }


    public function listing(array $filters = [], $withRelations  = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters,withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function getCompaniesForSelectDropDown(array $filters = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->queryGet(filters: $filters)->select(['id','name'])->get();
    }

    public function datatable(array $filters = [] , array $withRelations = []): Builder
    {
        return $this->queryGet(filters: $filters , withRelations: $withRelations);
    }

    /**
     * create new receiver
     * @param array $data
     * @return bool
     */
    public function store(CompanyDTO $companyDTO): bool
    {
        $company = $this->model->create($companyDTO->companyData());
        if($companyDTO->branchesData())
            foreach($companyDTO->branchesData() as $branch)
            {
                $branch['company_id'] = $company->id;
                $this->branchService->store(BranchDTO::fromArray(data: $branch));
            }
        if($companyDTO->departmentsData())
            foreach($companyDTO->departmentsData() as $department)
                $company->departments()->create($department);
        return true;
    }

    /**
     * update existing company
     * @param array $data
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function update(int $id, CompanyDTO $companyDTO): bool
    {
        $company = $this->findById($id);
        if (!$company)
            throw new NotFoundException(trans('lang.not_found'));
        $company->update($companyDTO->toArray());
        return true;
    }

    /**
     * delete existing company
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function destroy(int $id): bool
    {
        $company = $this->findById($id);
        if (!$company)
            throw new NotFoundException(trans('lang.not_found'));
        $company->delete();
        $company->deleteAddresses();
        return true;
    }

    /**
     * @throws NotFoundException
     */
    public function destroyMultiple(array $ids): bool
    {
        $companies = $this->findByIds($ids);
        if ($companies->isEmpty())
            throw new NotFoundException(trans('lang.not_found'));
        $companies->each(function ($company) {
            $company->delete();
            $company->deleteAddresses();
        });
        return true;
    }

}
