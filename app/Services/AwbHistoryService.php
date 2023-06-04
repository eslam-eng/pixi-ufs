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

    public function awbStatus(int $id, array $data):bool
    {
        $awb = Awb::find($id);
        if(!$awb)
            throw new NotFoundException(trans('app.not_found'));
        $data = [
            'user_id'=>$awb->user_id,
            'awb_status_id'=>$data['status_id'],
            'comment'=>$data['comment'],
        ];
        $awb->history()->create($data);
        return true;
    }


}
