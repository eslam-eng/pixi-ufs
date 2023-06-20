<?php

namespace App\DTO\AwbStatus;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class AwbStatusDTO extends BaseDTO
{

    /**
     * @param string $name
     * @param int $code
     * @param int $stepper
     * @param int $type
     * @param ?string $sms
     * @param ?string $description
     */
    public function __construct(
        protected string $name,
        protected ?int $code,
        protected int $stepper,
        protected int $type,
        protected ?string $sms,
        protected ?string $description,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            code: $request->code,
            stepper: $request->stepper,
            type: $request->type,
            sms: $request->sms,
            description: $request->description,
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
            code: Arr::get($data,'code'),
            stepper: Arr::get($data,'stepper'),
            type: Arr::get($data,'type'),
            sms: Arr::get($data,'sms'),
            description: Arr::get($data,'description'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "code" => $this->code,
            "stepper" => $this->stepper,
            'type' => $this->type,
            'sms' => $this->sms,
            'description' => $this->description,
        ];
    }

}
