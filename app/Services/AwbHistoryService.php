<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Awb;
use App\Models\AwbHistory;
class AwbHistoryService extends BaseService
{

    public function __construct(public AwbHistory $model)
    {
    }

    public function getModel(): AwbHistory
    {
       return  $this->model ;
    }

    public function changeMultipleAwbStatus(int $status , array $awb_ids = [])
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


    public function status(Awb $awb , array $data = [])
    {
        return $awb->history()->create($data);
    }

}
