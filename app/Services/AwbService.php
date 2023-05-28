<?php

namespace App\Services;

use App\DTO\Awb\AwbDTO;
use App\Exceptions\NotFoundException;
use App\Models\Awb;
use App\Models\Receiver;
use App\QueryFilters\AwbFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class AwbService extends BaseService
{

    public function __construct(public Awb $model)
    {
    }

    //method for api with pagination
    public function listing(array $filters = [], array $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function queryGet(array $filters = [], array $withRelations = []): Builder
    {
        $awbs = $this->model->query()->with($withRelations);
        return $awbs->filter(new AwbFilters($filters));
    }

    
    public function store(AwbDTO $awbDTO)
    {
        //Store main awb data
        $awbDTO->zone_price = 20;
        $awbDTO->additional_kg_price = 10 ;


    }

    public function cancelAwb(int $id, array $data):bool
    {
        $awb = $this->find($id);
        $data = [
            'user_id'=>$awb->user_id,
            'awb_status_id'=>1,
            'comment'=>$data['comment'],
        ];
        $awb->history()->create($data);
        return true;
    }

    //there is no date to update it
    public function awbReschedule(int $id, array $data):bool
    {
        $awb = $this->find($id);
        $data = [
            'user_id'=>$awb->user_id,
            'awb_status_id'=>$data['status_id'],
        ];
        $awb->history()->create($data);
        return true;
    }

    public function updateReceiverPhone(int $id, array $data):bool
    {
        $receiver = Receiver::find($id);
        $receiver->update([
            'phone'=>$data['phone'],
        ]);
        return true;
    }
    
    public function AddPhoneAndAddress(int $id, array $data):bool
    {
        $receiver = Receiver::find($id);
        if(!$receiver)
            throw new NotFoundException(trans('app.not_found'));
        $receiver->update([
            'phone'=>$data['phone'],
        ]);
        $receiver->storeAddress(Arr::except($data, $data['phone']));
        return true;
    }

    public function find(int $id, array $relations = [])
    {
        $awb = Awb::with($relations)->find($id);
        if(!$awb)
            throw new NotFoundException(trans('app.not_found'));
        return $awb;
    }

}
