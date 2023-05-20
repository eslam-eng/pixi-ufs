<?php

namespace App\QueryFilters;

use App\Abstracts\QueryFilter;

class ImportLogsFilter extends QueryFilter
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    public function id($term)
    {
        return $this->builder->where('id',$term);
    }

    public function created_by($term)
    {
        return $this->builder->where('created_by',$term);

    }

}
