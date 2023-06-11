<?php

namespace App\Http\Controllers\Api;

use App\Enums\ImportTypeEnum;
use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Exports\ReceiversExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\Receivers\PriceTableUpdateRequest;
use App\Http\Requests\Receivers\ReceiverUpdateAddressAndPhone;
use App\Http\Requests\Receivers\ReceiverUpdatePhone;
use App\Imports\Receivers\ReceiversImport;
use App\Services\BranchService;
use App\Services\ReceiverService;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class ReceiverController extends Controller
{
    public function __construct(protected ReceiverService $receiverService, protected BranchService $branchService)
    {

    }


    public function updateReceiverPhone(ReceiverUpdatePhone $request, $id)
    {
        try {
            $status = $this->receiverService->updateReceiverPhone(id: $id, data: $request->validated());
            if (!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function updateReceiverAddress(PriceTableUpdateRequest $request, $id)
    {
        try {
            $status = $this->receiverService->updateReceiverAddress(id: $id, data: $request->validated());
            if (!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    public function AddPhoneAndAddress(ReceiverUpdateAddressAndPhone $request, $id)
    {
        try {
            $status = $this->receiverService->AddPhoneAndAddress(id: $id, data: $request->validated());
            if (!$status)
                return apiResponse(message: trans('app.something_went_wrong'), code: 422);
            return apiResponse(message: trans('app.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        }
    }

    /**
     * delete existing receiver
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            $this->receiverService->destroy(id: $id);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function downloadReceiversTemplate(Excel $excel)
    {
        $user = getAuthUser();
        $filters = [];
        if ($user->type == UsersType::SUPERADMIN())
            $filters['company_id'] = 1;
        $branches = $this->branchService->getAll(filters: $filters);
        ob_end_clean();
        ob_start();
        return $excel->download(new ReceiversExport($branches), 'receivers' . time() . '.xlsx');
    }

    public function ImportReceivers(FileUploadRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = getAuthUser();
            $file = $request->file('file');
            $importObject = new ReceiversImport(
                creator: $user,
                importation_type: ImportTypeEnum::RECEIVERS(),
            );
            $importObject->import($file)->onQueue('default');
            DB::commit();
            return apiResponse(message: trans('app.import_success_message'));
        } catch (Exception $exception) {
            DB::rollBack();
            return apiResponse(message: $exception->getMessage(), code: $exception->getCode());
        }
    }
}
