<?php

namespace App\Http\Requests\Awb;

use App\Enums\AwbStatuses;
use App\Http\Requests\BaseRequest;
use App\Models\AwbStatus;
use Illuminate\Validation\Rule;

class AwbChangeStatusRequest extends BaseRequest
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
            'awb_status_id' => 'required|exists:awb_statuses,id',
            'lat' => 'nullable|string',
            'lng' => 'nullable|string',
            'comment' => 'nullable|string',

            'actual_recipient' => ['nullable', Rule::requiredIf(function () {
                return   !isset($this->images) && $this->status?->code == AwbStatuses::DELIVERED->value;
            })
            ],
            'title' => 'nullable|string',
            'card_number' => ['nullable', Rule::requiredIf(function () {
                return !isset($this->images)  && $this->status?->code == AwbStatuses::DELIVERED->value;
            })
            ],
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:png,jpg',
            'status' => 'required',
            'user_id' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status' => AwbStatus::query()->find($this->awb_status_id),
            'user_id'=>auth()->id()
        ]);
    }

}
