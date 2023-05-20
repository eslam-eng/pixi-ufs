<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GeneralException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Address\AddressStoreRequest;
use App\Http\Requests\Api\Address\AddressUpdateRequest;
use App\Http\Resources\AddressResource;
use App\Services\AddressService;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct(private AddressService $addressService)
    {

    }

    /**
     * get all addresses
     * @param Request $request
     */
    public function index()
    {
        try {
            $withRelations = ['city', 'area'];
            $addresses = $this->addressService->listing(filters: [], withRelations: $withRelations);
            return AddressResource::collection($addresses);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: $e->getCode());
        }
    }

    /**
     * create new address
     * @param AddressStoreRequest $request
     */
    public function store(AddressStoreRequest $request)
    {
        try {
            $addressDTO = $request->toAddressDTO();
            $this->addressService->store($addressDTO);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    public function edit(int $id)
    {
        try {

            $address=$this->addressService->findById(id: $id,withRelations: ['city','area']);
            return  new AddressResource($address);
        }catch (NotFoundException $exception){
            return apiResponse(message: $exception->getMessage(), code: $exception->getCode());

        }catch (\Exception $exception)
        {
            return apiResponse(message: trans('lang.something_went_wrong'), code: $exception->getCode());

        }
    }

    /**
     * update existing address
     * @param AddressUpdateRequest $request
     * @param int $id //address id
     */
    public function update(AddressUpdateRequest $request, int $id)
    {
        try {
            $addressDTO = $request->toAddressDTO();
            $this->addressService->update(id: $id,addressDTO: $addressDTO);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    /**
     * delete existing address
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            $this->addressService->destroy(id: $id);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (NotFoundException|GeneralException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }
}
