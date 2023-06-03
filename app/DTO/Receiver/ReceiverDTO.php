<?php

namespace App\DTO\Receiver;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class ReceiverDTO extends BaseDTO
{

    public function __construct(
        protected string $name,
        protected string $phone1,
        protected string $phone2,
        protected ?string $receiving_company,
        protected ?string $receiving_branch,
        protected int    $company_id,
        protected int    $branch_id,
        protected int    $city_id,
        protected int    $area_id,
        protected ?string $reference,
        protected ?string $title,
        protected ?string $notes,
        protected string $address1,
        protected ?string $address2,
        protected ?string $lat,
        protected ?string $lng,
        protected ?string $map_url,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            phone1: $request->phone1,
            phone2: $request->phone2,
            receiving_company: $request->receiving_company,
            receiving_branch: $request->receiving_branch,
            company_id: $request->company_id,
            branch_id: $request->branch_id,
            city_id: $request->city_id,
            area_id: $request->area_id,
            reference: $request->reference,
            title: $request->title,
            notes: $request->notes,
            address1: $request->address1,
            address2: $request->address2,
            lat: $request->lat,
            lng: $request->lng,
            map_url: $request->map_url,

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
            phone1: Arr::get($data,'phone1'),
            phone2: Arr::get($data,'phone2'),
            receiving_company: Arr::get($data,'receiving_company'),
            receiving_branch: Arr::get($data,'receiving_branch'),
            company_id: Arr::get($data,'company_id'),
            branch_id: Arr::get($data,'branch_id'),
            city_id: Arr::get($data,'city_id'),
            area_id: Arr::get($data,'area_id'),
            reference: Arr::get($data,'reference'),
            title: Arr::get($data,'title'),
            notes: Arr::get($data,'notes'),
            address1: Arr::get($data,'address1'),
            address2: Arr::get($data,'address2'),
            lat: Arr::get($data,'lat'),
            lng: Arr::get($data,'lng'),
            map_url: Arr::get($data,'map_url'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "phone1" => $this->phone1,
            "phone2" => $this->phone2,
            "receiving_company" => $this->receiving_company,
            "receiving_branch" => $this->receiving_branch,
            "reference" => $this->reference,
            "title" => $this->title,
            "notes" => $this->notes,
            "company_id" => $this->company_id,
            "branch_id" => $this->branch_id,
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'map_url' => $this->map_url,


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
