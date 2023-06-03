<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;
use Illuminate\Support\Facades\DB;

class AwbsFilter extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function id($term)
    {
        return $this->builder->where('id',$term);
    }

    public function ids($term)
    {
        return $this->builder->whereIn('id',$term);
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
