<?php

namespace App\Services;

use App\DTO\PriceTable\PriceTableDTO;
use App\Exceptions\NotFoundException;
use App\Models\Location;
use App\Models\PriceTable;
use App\QueryFilters\DepartmentsFilters;
use App\QueryFilters\PriceTablesFilters;
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

    public function listing(array $filters = [], array $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->priceTableQueryBuilder(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function priceTableQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $priceTables = $this->getQuery()->with($withRelations);
        return $priceTables->filter(new PriceTablesFilters($filters));
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
            $base_city_id = Location::where('title', 'cairo')->first()?->id;
            $base_distination = Location::where('title', 'Other')->first()?->id;
            $priceTable = $this->getQuery()
                ->where('location_from',$base_city_id)->where('location_to',$base_distination)->first();
        }
        return $priceTable;
    }

    public function increaseCompanyPrice(int $company_id,float $increase_percentage): bool
    {
        $pricesForCompany = $this->getQuery()->where('company_id',$company_id)->get();
        foreach ($pricesForCompany as $model)
        {
            $new_price = $model->price * (1 + ($increase_percentage / 100));
            $new_additional_price = $model->additional_kg_price * (1 + ($increase_percentage / 100));
            $model->update(['price'=>$new_price,'additional_kg_price'=>$new_additional_price]);
        }
        return true ;

    }
}
