<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class PriceTablesFilters extends QueryFilter
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
        return $this->builder->where('company_id',$term);
    }

    public function location_from($term)
    {
        return $this->builder->where('location_from',$term);

    }
    public function location_to($term)
    {
        return $this->builder->where('location_to',$term);

    }

}
