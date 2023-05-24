<?php

namespace App\Http\Controllers;

use App\DataTables\ReceiversDatatable;
use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Exports\ReceiversExport;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\Receivers\ReceiverStoreRequest;
use App\Http\Requests\Receivers\ReceiverUpdateRequest;
use App\Http\Resources\Receiver\ReceiverEditResource;
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
    public function index(ReceiversDatatable $receiversDatatable , Request $request)
    {
        try {
            $user = auth()->user();
            $filters = array_filter($request->get('filters',[]));
            if ($user->type != UsersType::SUPERADMIN())
                $filters['company_id'] = $user->company_id ;

            $withRelations = ['defaultAddress','branch:id,name,company_id','branch.company:id,name'];
            return $receiversDatatable->with(['filters'=>$filters,'withRelations'=>$withRelations])->render('layouts.dashboard.receivers.index');
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }

    public function create()
    {
        return view('layouts.dashboard.receivers.create');
    }

    public function store(ReceiverStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $receiverDto = $request->toReceiverDTO();
            $this->receiverService->store($receiverDto);
            DB::commit();
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.receiver_created_successfully')
            ];
            return back()->with('toast',$toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }



    public function show(int $id)
    {
        try {
            $withRelations = ['branch.company:id,name','addresses'=>fn($query)=>$query->with(['city','area'])];
            $receiver = $this->receiverService->findById(id: $id, withRelations: $withRelations);
            return ReceiverEditResource::make($receiver);

        }catch (Exception|NotFoundException $exception)
        {
            return apiResponse(message: $exception->getMessage(),code: 404);
        }
    }


    public function edit(int $id)
    {
        try {
            $withRelations = ['addresses' => fn($query) => $query->with(['city', 'area'])];
            $receiver = $this->receiverService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.receivers.edit',['receiver'=>$receiver]);
        } catch (Exception|NotFoundException $exception) {
            return apiResponse(message: $exception->getMessage(), code: 404);
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

    public function search(Request $request)
    {
        try {
            $key_word = $request->get('keyword');
            $filters  = ['keyword'=>$key_word] ;
            $receivers = app()->make(ReceiverService::class)->receiverQueryBuilder(filters: $filters,withRelations: ['defaultAddress','branch:id,name'])->limit(15)->get();
            return apiResponse(data: $receivers ,code: 200);
        }catch (Exception $exception)
        {
            dd($exception);
            return apiResponse(message: $exception->getMessage(),code: 500);
        }
    }
}
