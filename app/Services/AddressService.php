<?php

namespace App\Services;

use App\DTO\Address\AddressDTO;
use App\Enums\AddressTypes;
use App\Exceptions\GeneralException;
use App\Exceptions\NotFoundException;
use App\Models\Address;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Receiver;
use App\QueryFilters\AddressesFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AddressService extends BaseService
{

    public function __construct(public Address $model)
    {
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    //method for api with pagination
    public function listing(array $filters = [], $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->addressQueryBuilder(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function addressQueryBuilder(array $filters = [], array $withRelations = []): Builder
    {
        $addresses = $this->getQuery()->with($withRelations);
        return $addresses->filter(new AddressesFilters($filters));
    }

    /**
     * create new address
     * @param array $data
     * @return bool
     */
    public function store(AddressDTO $addressDTO): bool
    {
        $model = match ($addressDTO->addressable_type) {
            AddressTypes::RECEIVER->value => Receiver::find($addressDTO->addressable_id),
            AddressTypes::COMPANY->value => Company::find($addressDTO->addressable_id),
            AddressTypes::BRANCH->value => Branch::find($addressDTO->addressable_id),
            default => throw new \Exception('Unexpected match value'),
        };

        if (isset($model)) {
            if ($addressDTO->is_default)
                $model->addresses()->update(['is_default' => false]);
            $model->storeAddress(Arr::except($addressDTO->toArray(), ['addressable_type', 'addressable_id']));
        }
        return true;
    }


    /**
     * update existing address
     * @param array $data
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function update(int $id, AddressDTO $addressDTO): bool
    {
        $address = $this->findById(id: $id);
        if (!$address)
            throw new NotFoundException(trans('lang.not_found'));

        if ($addressDTO->is_default)
            $this->getQuery()->where('addressable_id', $address->addressable_id)->where('addressable_type', $address->addressable_type)->update(['is_default' => false]);
        return $address->update(Arr::except($addressDTO->toArray(), ['addressable_type', 'addressable_id']));
    }

    /**
     * delete existing address
     * @param int $id
     * @return bool
     * @throws NotFoundException
     * @throws GeneralException
     */
    public function destroy(int $id): bool
    {
        $address = $this->findById(id: $id);
        //get_addresses_count
        $addresses_count = $this->getQuery()->where('addressable_id', $address->addressable_id)->where('addressable_type', $address->addressable_type)->count();
        if (!$address)
            throw new NotFoundException(trans('lang.not_found'));
        if ($addresses_count <= 1)
            throw new GeneralException(trans('lang.cannot_delete_address'));
        if ($address->is_default)
            throw new GeneralException(trans('lang.set_another_default_address_before_deleting'));
        return true;
    }

    public function setAddressDefault(int $id): bool
    {
        $address = $this->findById($id);
//        set all default false
        $this->getQuery()->where('addressable_id',$address->addressable_id)->where('addressable_type',$address->addressable_type)->update(['is_default'=>false]);
        $address->update(['is_default'=>1]);
        return true ;

    }

}
