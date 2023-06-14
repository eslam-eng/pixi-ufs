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

    public function phone($term){
        return $this->builder->where('phone',$term);
    }

    public function show_dashboard($term){
        return $this->builder->where('show_dashboard',$term);
    }

    public function num_custom_fields($term){
        return $this->builder->where('num_custom_fields',$term);
    }

    public function keyword($term)
    {
        return $this->builder->search($term);
    }
}
