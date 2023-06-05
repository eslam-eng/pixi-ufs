<?php

namespace App\Services;

use App\DTO\PriceTable\PriceTableDTO;
use App\Exceptions\NotFoundException;
use App\Models\Location;
use App\Models\PriceTable;
use App\QueryFilters\DepartmentsFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PriceTableService extends BaseService
{

    public function __construct(public PriceTable $model)
    {
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function priceTableQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $departments = $this->getQuery()->with($withRelations);
        return $departments->filter(new DepartmentsFilters($filters));
    }

    /**
     * create new department
     * @param array $data
     * @return bool
     */
    public function store(PriceTableDTO $priceTableDTO)
    {
        return $this->model->create($priceTableDTO->toArray());
    }

    /**
     * update existing department
     * @param array $data
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function update(int $id, PriceTableDTO $priceTableDTO): bool
    {
        $price_table = $this->findById($id);
        if (!$price_table)
            throw new NotFoundException(trans('lang.not_found'));
        $price_table->update($priceTableDTO->toArray());
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
        $price_table = $this->findById($id);
        if (!$price_table)
            throw new NotFoundException(trans('lang.not_found'));
        $price_table->delete();
        return true;
    }

    /**
     * @throws NotFoundException
     */
    public function getShipmentPrice(int $from, int $to): Model|Builder
    {
        $priceTable = $this->getQuery()->where(function ($query) use ($from, $to) {
            $query->where('location_from', $from)->where('location_to', $to);
        })->where(function ($query) use ($from, $to) {
            $query->where('location_from', $to)->where('location_to', $from);
        })->first();
        if (!$priceTable) {
            //todo get base governorates from settings
            $base_city_id = Location::where('title', 'cairo')->first()?->id;
            $priceTable = $this->getQuery()
                ->where(function ($query) use ($from, $to, $base_city_id) {
                    $query->where('location_from', $base_city_id)->where('location_to', $from);
                })
                ->where(function ($query) use ($from, $to, $base_city_id) {
                    $query->where('location_from', $base_city_id)->where('location_to', $to);
                })
                ->orderBy('price', 'desc')
                ->first();
        }
        if (!$priceTable) {
            //todo get base governorates and other location id from settings
            $priceTable = Location::where('title', 'cairo')->where('title','Other')->first()?->id;
        }
        return $priceTable;
    }
}
