<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class BranchesFilters extends QueryFilter
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
        return $this->builder->whereRelation('company','id',$term);
    }

    public function keyword($term)
    {
        return $this->builder->where('name', 'LIKE', "{$term}%")->orWhere('phone', 'LIKE', "{$term}%");
    }

}
