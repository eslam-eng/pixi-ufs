<?php

namespace App\DTO\AwbStatus;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class AwbStatusDTO extends BaseDTO
{

    /**
     * @param string $name
     * @param int $is_final
     * @param int $stepper
     * @param int $type
     * @param ?string $sms
     */
    public function __construct(
        protected string $name,
        protected int $is_final,
        protected int    $stepper,
        protected int    $type,
        protected ?string   $sms,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            is_final: $request->is_final,
            stepper: $request->stepper,
            type: $request->type,
            sms: $request->sms,
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
            is_final: Arr::get($data,'is_final'),
            stepper: Arr::get($data,'stepper'),
            type: Arr::get($data,'type'),
            sms: Arr::get($data,'sms'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "is_final" => $this->is_final,
            "stepper" => $this->stepper,
            'type' => $this->type,
            'sms' => $this->sms,
        ];
    }

}
