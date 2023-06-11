<?php

namespace App\Services;

use App\DTO\Branch\BranchDTO;
use App\Exceptions\NotFoundException;
use App\Models\Branch;
use App\QueryFilters\BranchesFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BranchService extends BaseService
{

    public function __construct(public Branch $model)
    {
    }

    public function getModel(): Model
    {
        return $this->model;
    }
    //method for api with pagination
    public function listing(array $filters = [], array $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->branchQueryBuilder(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function branchQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $branches = $this->getQuery()->with($withRelations);
        return $branches->filter(new BranchesFilters($filters));
    }

    public function getAll(array $filters = [], array $withRelations = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->branchQueryBuilder(filters: $filters , withRelations: $withRelations)->get();
    }

    /**
     * create new branch
     * @param array $data
     * @return bool
     */
    public function store(BranchDTO $branchDTO): bool
    {
        $branch = $this->model->create($branchDTO->toArray());
        return true;
    }

    /**
     * update existing branch
     * @param array $data
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function update(int $id, BranchDTO $branchDTO): bool
    {
        $branch = $this->find($id);
        if (!$branch)
            throw new NotFoundException(trans('lang.not_found'));
        $branch->update($branchDTO->toArray());
        return true;
    }

    /**
     * delete existing branch
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function destroy(int $id): bool
    {
        $branch = Branch::find($id);
        $branch->delete();
        return true;
    }

    public function getBranchesForSelectDropDown(array $filters = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->branchQueryBuilder(filters: $filters)->select(['id','name'])->get();
    }

}
