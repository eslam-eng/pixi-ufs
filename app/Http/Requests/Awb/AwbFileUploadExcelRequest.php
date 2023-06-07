<?php

namespace App\Http\Requests\Awb;

use App\Enums\PaymentTypesEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class AwbFileUploadExcelRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'payment_type'=>['required','integer',Rule::in(PaymentTypesEnum::values())],
            'service_type_id'=>'required|integer|exists:awb_service_types,id',
            'shipment_type_id'=>'required|integer|exists:company_shipment_types,id',
            'file'=>'required|file|mimes:xls,xlsx',
        ];
    }

}
