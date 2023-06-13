<?php

namespace App\Http\Requests\AwbStatus;

use App\Enums\Stepper;
use App\Enums\AwbStatuses;
use App\Enums\AwbStatusCategory;
use App\DTO\AwbStatus\AwbStatusDTO;
use App\Http\Requests\BaseRequest;

class AwbStatusStoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|integer|in:'.AwbStatuses::CREATE_SHIPMENT->value.','.AwbStatuses::CALLING_RECEIVER->value.','.AwbStatuses::DELIVERED->value,
            'is_final' => 'required|integer',
            'stepper' => 'required|integer|in:'.Stepper::INCOMPANY->value.','.Stepper::PROCESSING->value.','.Stepper::HOLD->value.','.Stepper::DELIVERED->value,
            'type' => 'required|integer||in:'.AwbStatusCategory::AWB->value.','.AwbStatusCategory::PICKUP->value.','.AwbStatusCategory::CANCEL_REASON->value,
            'sms' => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }

    public function toAwbStatusDTO(): \App\DTO\BaseDTO|AwbStatusDTO
    {
        return AwbStatusDTO::fromRequest($this);
    }
}
