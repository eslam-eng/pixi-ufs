<?php

namespace App\Services;

use App\DTO\Department\DepartmentDTO;
use App\Exceptions\NotFoundException;
use App\Models\Department;
use App\QueryFilters\DepartmentsFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DepartmentService extends BaseService
{

    public function __construct(public Department $model)
    {
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    //method for api with pagination
    public function listing(array $filters = [], array $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->departmentQueryBuilder(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function departmentQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $departments = $this->getQuery()->with($withRelations);
        return $departments->filter(new DepartmentsFilters($filters));
    }

    public function getAll(array $filters = [],array $withRelations=[]): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->departmentQueryBuilder(filters: $filters , withRelations: $withRelations)->get();
    }

    /**
     * create new department
     * @param array $data
     * @return bool
     */
    public function store(DepartmentDTO $departmentDTO)
    {
       return $this->model->create($departmentDTO->toArray());
    }

    /**
     * update existing department
     * @param array $data
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function update(int $id, DepartmentDTO $departmentDTO): bool
    {
        $department = $this->find($id);
        $department->update($departmentDTO->toArray());
        return true;
    }

    /**
     * delete existing department
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function destroy(int $id): bool
    {
        $department = $this->find($id);
        $department->delete();
        return true;
    }

    public function find(int $id): Model
    {
        $department = Department::find($id);
        if (!$department)
            throw new NotFoundException(trans('lang.not_found'));
        return $department;
    }

    public function getDepartmentsForSelectDropDown(array $filters = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->departmentQueryBuilder(filters: $filters)->select(['id','name'])->get();
    }

}
