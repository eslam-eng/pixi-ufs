<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;
use Illuminate\Support\Arr;

class AwbStatusFilters extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function id($term)
    {
        return $this->builder->where('id', $term);
    }

    public function code($term)
    {
        return $this->builder->where('code',$term);
    }

    public function is_final($term)
    {
        return $this->builder->where('is_final',$term);

    }
    public function stepper($term)
    {
        return $this->builder->where('stepper',$term);

    }

    public function type($term)
    {
        return $this->builder->whereIn('type',Arr::wrap($term));

    }

    public function sms($term)
    {
        return $this->builder->where('sms',$term);

    }

}
