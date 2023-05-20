<?php

namespace App\Services;

use App\Models\Location;
use App\QueryFilters\LocationsFilter;

class LocationsService extends BaseService
{

    public function __construct(public Location $model)
    {
    }

    public function queryGet(array $filter = [])
    {
        $result = $this->model->query();
        return $result->filter(new LocationsFilter($filter));
    }


    public function getAll(array $filters = [])
    {
        return $this->queryGet($filters)->get();
    }

    public function getLocationAncestors($id)
    {
        return $this->model->defaultOrder()->ancestorsAndSelf($id);
    }

    public function getLocationDescendants($location_id)
    {
        return $this->model->defaultOrder()->descendantsOf($location_id) ;
    }

}
