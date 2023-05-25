<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class ReceiversFilters extends QueryFilter
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
        return $this->builder->whereRelation('branch.company','id',$term);
    }

    public function branch_id($term)
    {
        return $this->builder->where('branch_id',$term);

    }

    public function reference($term)
    {
        return $this->builder->where('reference',"LIKE","%{$term}%");
    }

    public function city_id($term)
    {
        return $this->builder->whereHas('addresses',fn($address)=>$address->where('city_id',$term));
    }

    public function area_id($term)
    {
        return $this->builder->whereHas('addresses',fn($address)=>$address->where('area_id',$term));

    }

    public function keyword($term)
    {
        return $this->builder->where('name', 'LIKE', "%{$term}%")->orWhere('phone', 'LIKE', "%{$term}%")->where('reference',"LIKE","%{$term}%");
    }

}
