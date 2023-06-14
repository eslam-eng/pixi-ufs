<?php

namespace App\Services;

use App\DTO\AwbStatus\AwbStatusDTO;
use App\DTO\PriceTable\PriceTableDTO;
use App\Exceptions\NotFoundException;
use App\Models\AwbStatus;
use App\QueryFilters\AwbStatusFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AwbStatusService extends BaseService
{

    public function __construct(public AwbStatus $model)
    {
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function AwbStatusQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $awbStatus = $this->getQuery()->with($withRelations);
        return $awbStatus->filter(new AwbStatusFilters($filters));
    }

    /**
     * create new awb status
     * @param array $data
     * @return bool
     */
    public function store(AwbStatusDTO $awbStatusDTO)
    {
        return $this->model->create($awbStatusDTO->toArray());
    }

    /**
     * update existing awb status
     * @param array $data
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function update(int $id, AwbStatusDTO $awbStatusDTO): bool
    {
        $awbStatus = $this->findById($id);
        $awbStatus->update($awbStatusDTO->toArray());
        return true;
    }

    /**
     * delete existing awb status
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function destroy(int $id): bool
    {
        $awbStatus = $this->findById($id);
        $awbStatus->delete();
        return true;
    }
}
