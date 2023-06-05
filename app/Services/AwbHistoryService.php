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

    public function changeAwbStatus(int $status , array $awb_ids = [])
    {
        $inserted_data = [];
        $user_id = auth()->id();
        foreach ($awb_ids as $id)
        {
            $inserted_data []= [
                'awb_id'=>$id,
                'user_id'=>$user_id,
                'awb_status_id'=>$status
            ];
        }

        return $this->model->insert($inserted_data);
    }

}
