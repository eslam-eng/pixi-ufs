<?php

namespace App\DTO\AwbHistory;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class AwbHistoryDTO extends BaseDTO
{

    /**
     * @param int $awb_id
     * @param int $user_id
     * @param int $awb_status_id
     * @param ?string $comment
     */
    public function __construct(
        protected int $awb_id,
        protected int $user_id,
        protected int    $awb_status_id,
        protected ?string   $comment,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            awb_id: $request->awb_id,
            user_id: $request->user_id,
            awb_status_id: $request->awb_status_id,
            comment: $request->comment,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            awb_id: Arr::get($data,'awb_id'),
            user_id: Arr::get($data,'user_id'),
            awb_status_id: Arr::get($data,'awb_status_id'),
            comment: Arr::get($data,'comment'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "awb_id" => $this->awb_id,
            "user_id" => $this->user_id,
            "awb_status_id" => $this->awb_status_id,
            'comment' => $this->comment,
        ];
    }

}
