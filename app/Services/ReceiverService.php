<?php

namespace App\Services;

use App\DTO\Receiver\ReceiverDTO;
use App\Exceptions\NotFoundException;
use App\Models\Receiver;
use App\QueryFilters\ReceiversFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ReceiverService extends BaseService
{

    public function __construct(public Receiver $model)
    {
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    //method for api with pagination
    public function listing(array $filters = [], array $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->receiverQueryBuilder(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function receiverQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $receivers = $this->getQuery()->with($withRelations);
        return $receivers->filter(new ReceiversFilters($filters));
    }

    public function datatable(array $filters = [] , array $withRelations = []): Builder
    {
        return $this->receiverQueryBuilder(filters: $filters , withRelations: $withRelations);
    }

    /**
     * create new receiver
     * @param array $data
     * @return bool
     */
    public function store(ReceiverDTO $receiverDTO)
    {
        return $this->model->create($receiverDTO->toArray());
    }

    /**
     * update existing receiver
     * @param array $data
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function update(int $id, ReceiverDTO $receiverDTO): bool
    {
        $receiver = $this->findById($id);
        if (!$receiver)
            throw new NotFoundException(trans('lang.not_found'));
        $receiver->update($receiverDTO->toArray());
        return true;
    }

    /**
     * delete existing receiver
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function destroy(int $id): bool
    {
        $receiver = $this->findById($id);
        $receiver->delete();
        $receiver->deleteAddresses();
        return true;
    }

    public function updateReceiverPhone(int $id, array $data):bool
    {
        $receiver = $this->findById($id);
        $receiver->update([
            'phone2'=>$data['phone'],
        ]);
        return true;
    }

    public function updateReceiverAddress(int $id, array $data):bool
    {
        $receiver = $this->findById($id);
        $receiver->update([
            'address1'=>$data['address'],
            'lat'=>$data['lat'],
            'lng'=>$data['lng'],
            'map_url'=>$data['map_url'],
            'city_id'=>$data['city_id'],
            'area_id'=>$data['area_id'],
        ]);
        return true;
    }

    public function AddPhoneAndAddress(int $id, array $data):bool
    {
        $receiver = $this->findById($id);
        $receiver->update([
            'address1'=>$data['address'],
            'lat'=>$data['lat'],
            'lng'=>$data['lng'],
            'map_url'=>$data['map_url'],
            'city_id'=>$data['city_id'],
            'area_id'=>$data['area_id'],
            'phone2'=>$data['phone'],
        ]);
        return true;
    }

}
