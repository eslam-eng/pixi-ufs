<?php

namespace App\DTO\Awb;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class AwbDTO extends BaseDTO
{

    /**
     * @param int    $code
     * @param int    $user_id
     * @param int    $branch_id
     * @param int    $department_id
     * @param int    $receiver_id
     * @param object $receiver_data
     * @param string $payment_type
     * @param string $service_type
     * @param bool   $is_return
     * @param int    $company_shipment_type_id
     * @param float  $zone_price
     * @param float  $additional_kg_price
     * @param float  $collection
     * @param float  $weight
     * @param float  $pieces
     * @param float  $actual_recipient
     */
    public function __construct(
        public int    $user_id,
        public int    $branch_id,
        public int    $code,
        public int    $department_id,
        public int    $receiver_id,
        public object $receiver_data,
        public string $payment_type,
        public string $service_type,
        public bool   $is_return,
        public int    $company_shipment_type_id,
        public float  $zone_price,
        public float  $additional_kg_price,
        public float  $collection,
        public float  $weight,
        public float  $pieces,
        public float  $actual_recipient,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            code:                     $request->code,
            user_id:                  $request->user_id,
            branch_id:                $request->branch_id,
            department_id:            $request->department_id,
            receiver_id:              $request->receiver_id,
            receiver_data:            $request->receiver_data,
            payment_type:             $request->payment_type,
            service_type:             $request->service_type,
            is_return:                $request->is_return,
            company_shipment_type_id: $request->company_shipment_type_id,
            zone_price:               $request->zone_price,
            additional_kg_price:      $request->additional_kg_price,
            collection:               $request->collection,
            weight:                   $request->weight,
            pieces:                   $request->pieces,
            actual_recipient:         $request->actual_recipient,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            code:                     Arr::get($data,'code'),
            user_id:                  Arr::get($data,'user_id'),
            branch_id:                Arr::get($data,'branch_id'),
            department_id:            Arr::get($data,'department_id'),
            receiver_id:              Arr::get($data,'receiver_id'),
            receiver_data:            Arr::get($data,'receiver_data'),
            payment_type:             Arr::get($data,'payment_type'),
            service_type:             Arr::get($data,'service_type'),
            is_return:                Arr::get($data,'is_return'),
            company_shipment_type_id: Arr::get($data,'company_shipment_type_id'),
            zone_price:               Arr::get($data,'zone_price'),
            additional_kg_price:      Arr::get($data,'additional_kg_price'),
            collection:               Arr::get($data,'collection'),
            weight:                   Arr::get($data,'weight'),
            pieces:                   Arr::get($data,'pieces'),
            actual_recipient:         Arr::get($data,'actual_recipient'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "code" =>                    $this->code,
            "user_id" =>                 $this->user_id,
            "branch_id" =>               $this->branch_id,
            "department_id" =>           $this->department_id,
            "receiver_id" =>             $this->receiver_id,
            "receiver_data" =>           $this->receiver_data,
            "payment_type" =>            $this->payment_type,
            "service_type" =>            $this->service_type,
            "is_return" =>               $this->is_return,
            "company_shipment_type_id"=> $this->company_shipment_type_id,
            "zone_price" =>              $this->zone_price,
            "additional_kg_price" =>     $this->additional_kg_price,
            "collection" =>              $this->collection,
            "weight" =>                  $this->weight,
            "pieces" =>                  $this->pieces,
            "actual_recipient" =>        $this->actual_recipient,
        ];
    }

}
