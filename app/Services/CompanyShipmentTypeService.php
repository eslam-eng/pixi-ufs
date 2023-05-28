<?php

namespace App\Services;

use App\DTO\ServiceType\ServiceTypeDTO;
use App\Exceptions\NotFoundException;
use App\Models\AwbServiceType;
use App\Models\CompanyShipmentType;

class CompanyShipmentTypeService extends BaseService
{

    public function __construct(public CompanyShipmentType $model)
    {
    }

    public function getModel(): CompanyShipmentType
    {
        return $this->model;
    }


    public function getAll(array $filters = [], array $withRelations = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->getModel()->all();
    }

    /**
     * create new branch
     * @param array $data
     * @return bool
     */
    public function store(ServiceTypeDTO $serviceTypeDTO): bool
    {
        return $this->model->create($serviceTypeDTO->toArray());
    }

    /**
     * update existing branch
     * @param array $data
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function update(int $id, ServiceTypeDTO $serviceTypeDTO): bool
    {
        $serviceType = $this->findById($id);
        if (!$serviceType)
            throw new NotFoundException(trans('lang.not_found'));
        return $serviceType->update($serviceTypeDTO->toArray());
    }

    /**
     * delete existing branch
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function destroy(int $id): bool
    {
        $serviceType = $this->findById($id);
        if (!$serviceType)
            throw new NotFoundException(trans('lang.not_found'));
        return $serviceType->delete();
    }
}
