<?php

namespace App\Http\Controllers;

use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Exports\ReceiversExport;
use App\Http\Requests\FileUploadRequest;
use App\Http\Resources\Receiver\ReceiverEditResource;
use App\Http\Resources\Receiver\ReceiverResource;
use App\Imports\Receivers\ReceiversImport;
use App\Services\BranchService;
use App\Services\ReceiverService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class ReceiverController extends Controller
{
    public function __construct(protected ReceiverService $receiverService, protected BranchService $branchService)
    {

    }

    /**
     * get all receivers
     */
    public function index(Request $request)
    {
        try {
            $filters = array_filter($request->all());
            $withRelations = ['branch.company:id,name', 'defaultAddress'];
            $receivers = $this->receiverService->listing(filters: $filters, withRelations: $withRelations);
            return ReceiverResource::collection($receivers);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: $e->getCode());
        }
    }

//    public function show(int $id)
//    {
//        try {
//            $withRelations = ['branch.company:id,name','addresses'=>fn($query)=>$query->with(['city','area'])];
//            $receiver = $this->receiverService->findById(id: $id, withRelations: $withRelations);
//            return ReceiverEditResource::make($receiver);
//
//        }catch (Exception|NotFoundException $exception)
//        {
//            return apiResponse(message: $exception->getMessage(),code: 404);
//        }
//    }


    public function edit(int $id)
    {
        try {
            $withRelations = ['branch.company:id,name', 'addresses' => fn($query) => $query->with(['city', 'area'])];
            $receiver = $this->receiverService->findById(id: $id, withRelations: $withRelations);
            return ReceiverEditResource::make($receiver);
        } catch (Exception|NotFoundException $exception) {
            return apiResponse(message: $exception->getMessage(), code: 404);
        }
    }

    public function store(ReceiverStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $receiverDto = $request->toReceiverDTO();
            $this->receiverService->store($receiverDto);
            DB::commit();
            return apiResponse(message: trans('lang.success_operation'));
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

    public function update(ReceiverUpdateRequest $request, int $id)
    {
        try {
            $receiverDTO = $request->toReceiverDTO();
            $this->receiverService->update($id, $receiverDTO);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (Exception|NotFoundException $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
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
                (new ReceiversImport( auth_user: $user))->import($file)->onQueue('receivers_import');
            DB::commit();
            return apiResponse(message: trans('app.import_success_message'));
        }catch (Exception $exception)
        {
            DB::rollBack();
            return apiResponse(message: $exception->getMessage(),code: $exception->getCode());
        }
    }
}
