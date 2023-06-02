<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class CompaniesFilter extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function status($term)
    {
        return $this->builder->where('status',$term);
    }

    public function city_id($term)
    {
        return $this->builder->where('city_id',$term);
    }

    public function area_id($term){
        return $this->builder->where('area_id',$term);
    }

    public function keyword($term)
    {
        return $this->builder->search($term);
    }
}
