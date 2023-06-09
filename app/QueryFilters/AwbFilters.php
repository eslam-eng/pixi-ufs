<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AwbFilters extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function id($term)
    {
        return $this->builder->where('id', $term);
    }

    public function keyword($term)
    {
        return $this->builder->where('code', 'LIKE', "%{$term}%")->orWhere('receiver_reference', 'LIKE', "%{$term}%");
    }

    public function status_id($term)
    {
        return $this->builder->whereHas('latestStatus', function ($query) use ($term) {
            $query->where('awb_status_id', $term);
        });
    }

    public function city_id($term)
    {
        return $this->builder->whereHas('receiver', function ($query) use ($term) {
            $query->where('city_id', $term);
        });
    }

    public function area_id($term)
    {
        return $this->builder->whereHas('receiver', function ($query) use ($term) {
            $query->where('area_id', $term);
        });
    }

    public function ids($term)
    {
        return $this->builder->whereIn('id',Arr::wrap($term));
    }

    public function reference($term)
    {
        return $this->builder->where('receiver_reference',$term);
    }

    public function company_id($term)
    {
        return $this->builder->where('company_id',$term);
    }

    public function branch_id($term)
    {
        return $this->builder->where('branch_id',$term);
    }

    public function department_id($term)
    {
        return $this->builder->where('department_id',$term);
    }

    public function created_at($term)
    {
        return $this->builder ->whereBetween(DB::raw('DATE(created_at)'),$term);
    }

}
