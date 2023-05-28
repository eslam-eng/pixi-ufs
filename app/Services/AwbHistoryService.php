<?php

namespace App\Services;

use App\Models\Awb;
use App\Models\AwbHistory;
use Illuminate\Database\Eloquent\Model;

class AwbHistoryService extends BaseService
{

    public function __construct(public AwbHistory $model)
    {
    }

    public function getModel(): AwbHistory
    {
       return  $this->model ;
    }

    public function store()
    {

    }


}
