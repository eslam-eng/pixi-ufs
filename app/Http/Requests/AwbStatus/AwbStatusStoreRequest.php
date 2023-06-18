<?php

namespace App\Http\Requests\AwbStatus;

use App\Enums\Stepper;
use App\Enums\AwbStatuses;
use App\Enums\AwbStatusCategory;
use App\DTO\AwbStatus\AwbStatusDTO;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
//            'code' => ['required',Rule::in(AwbStatuses::values())],
            'is_final' => 'required|integer',
            'stepper' => ['required',Rule::in(Stepper::values())],
            'type' => ['required',Rule::in(AwbStatusCategory::values())],
            'sms' => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }

    public function toAwbStatusDTO(): \App\DTO\BaseDTO|AwbStatusDTO
    {
        return AwbStatusDTO::fromRequest($this);
    }
}
