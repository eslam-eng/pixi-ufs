<?php

namespace App\DTO\Receiver;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class ReceiverDTO extends BaseDTO
{



    public function __construct(
        protected string $name,
        protected string $phone,
        protected string $receiving_company,
        protected int    $branch_id,
        protected int    $city_id,
        protected int    $area_id,
        protected string $reference,
        protected ?string $title,
        protected ?string $notes,
        protected string $address,
        protected ?string $lat,
        protected ?string $lng,
        protected ?string $postal_code,
        protected ?string $map_url,
        protected ?bool   $is_default,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            phone: $request->phone,
            receiving_company: $request->receiving_company,
            branch_id: $request->branch_id,
            city_id: $request->city_id,
            area_id: $request->area_id,
            reference: $request->reference,
            title: $request->title,
            notes: $request->notes,
            address: $request->address,
            lat: $request->lat,
            lng: $request->lng,
            postal_code: $request->postal_code,
            map_url: $request->map_url,
            is_default: $request->is_default
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            name: Arr::get($data,'name'),
            phone: Arr::get($data,'phone'),
            receiving_company: Arr::get($data,'receiving_company'),
            branch_id: Arr::get($data,'branch_id'),
            city_id: Arr::get($data,'city_id'),
            area_id: Arr::get($data,'area_id'),
            reference: Arr::get($data,'reference'),
            title: Arr::get($data,'title'),
            notes: Arr::get($data,'notes'),
            address: Arr::get($data,'address'),
            lat: Arr::get($data,'lat'),
            lng: Arr::get($data,'lng'),
            postal_code: Arr::get($data,'postal'),
            map_url: Arr::get($data,'map_url'),
            is_default: Arr::get($data,'is_default')
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "phone" => $this->phone,
            "receiving_company" => $this->receiving_company,
            "reference" => $this->reference,
            "title" => $this->title,
            "notes" => $this->notes,
            "branch_id" => $this->branch_id,

            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'postal_code' => $this->postal_code,
            'map_url' => $this->map_url,
            'is_default' => $this->is_default

        ];
    }

    public function addressData(): array
    {
        return [

            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'postal_code' => $this->postal_code,
            'map_url' => $this->map_url,
            'is_default' => $this->is_default

        ];
    }

    public function receiverData(): array
    {
        return [
            "name" => $this->name,
            "phone" => $this->phone,
            "receiving_company" => $this->receiving_company,
            "reference" => $this->reference,
            "title" => $this->title,
            "notes" => $this->notes,
            "branch_id" => $this->branch_id,
        ];
    }

    public static function getValidationArray(): array
    {
        return [];
    }

    public function validate(): void
    {
    }
}
