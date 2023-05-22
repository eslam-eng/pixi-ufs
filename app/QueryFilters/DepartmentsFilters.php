<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class DepartmentsFilters extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function id($term)
    {
        return $this->builder->where('id', $term);
    }

    public function company_id($term)
    {
        return $this->builder->where('company_id','id',$term);
    }

    public function keyword($term)
    {
        return $this->builder->where('name', 'LIKE', "{$term}%")->orWhere('phone', 'LIKE', "{$term}%");
    }

}
