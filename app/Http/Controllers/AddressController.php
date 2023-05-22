<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Address\AddressStoreRequest;
use App\Http\Requests\Address\AddressUpdateRequest;
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

    public function create(Request $request)
    {
        return view('layouts.dashboard.addresses.create',['addressable_id' => $request->id,'addressable_type' => $request->type]);
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
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.receiver_address_created_successfully')
            ];
            return back()->with('toast',$toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }

    public function edit(int $id)
    {
        try {
            $address = $this->addressService->findById(id: $id, withRelations: ['city', 'area']);
            return view('layouts.dashboard.addresses.edit',['address'=>$address]);
        } catch (NotFoundException $exception) {
            return apiResponse(message: $exception->getMessage(), code: $exception->getCode());

        } catch (\Exception $exception) {
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
            $this->addressService->update(id: $id, addressDTO: $addressDTO);
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

    public function setAddressDefault(int $id)
    {
        try {
            $this->addressService->setAddressDefault(id: $id);
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.address_become_default')
            ];
            return back()->with('toast',$toast);

        }catch (Exception $exception)
        {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }
}
