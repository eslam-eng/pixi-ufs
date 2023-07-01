<?php

namespace App\Http\Controllers;

use App\DataTables\ReceiversDatatable;
use App\DTO\Receiver\ReceiverDTO;
use App\Enums\ImportTypeEnum;
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
        $this->middleware(['permission:view_receivers|edit_receivers|create_receivers']);
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

            $withRelations = ['city','area','branch:id,name,company_id','company:id,name'];
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
            $receiverDto = ReceiverDTO::fromRequest($request);
            $this->receiverService->store($receiverDto);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.receiver_created_successfully')
            ];
            return redirect()->route('receivers.index')->with('toast',$toast);
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
            return view('layouts.dashboard.receivers.show',['receiver'=>$receiver]);

        }catch (Exception|NotFoundException $exception)
        {
            return apiResponse(message: $exception->getMessage(),code: 404);
        }
    }


    public function edit(int $id)
    {
        try {
            $withRelations = ['city', 'area'];
            $receiver = $this->receiverService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.receivers.edit',['receiver'=>$receiver]);
        } catch (Exception|NotFoundException $exception) {
            return apiResponse(message: $exception->getMessage(), code: 404);
        }
    }

     public function update(ReceiverUpdateRequest $request, int $id)
    {
        try {
            $receiverDTO = ReceiverDTO::fromRequest($request);
            $this->receiverService->update($id, $receiverDTO);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.success_operation')
            ];
            return redirect()->route('receivers.index')->with('toast',$toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast',$toast);
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

    public function importForm()
    {
        return view('layouts.dashboard.receivers.importation.form');
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function downloadReceiversTemplate(Excel $excel)
    {
        $user = getAuthUser();
        $filters = [];
        if ($user->type == UsersType::ADMIN())
            $filters['company_id'] = $user->company_id;
        if ($user->type == UsersType::EMPLOYEE)
            $filters['id'] = $user->branch_id ;
        $withRelations = ['company:id,name'];
        $branches = $this->branchService->getAll(filters: $filters,withRelations: $withRelations);
        return $excel->download(new ReceiversExport($branches), 'receivers' . time() . '.xlsx');
    }

    public function import(FileUploadRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = getAuthUser();
            $importation_type = ImportTypeEnum::RECEIVERS->value;
            $file = $request->file('file');
            $importObject = new ReceiversImport( creator: $user,importation_type: $importation_type);
            $importObject->import($file)->onQueue('default');
            DB::commit();
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.import_success_message')
            ];
            return to_route('import-logs.index')->with('toast',$toast);
        }catch (Exception $exception)
        {
            DB::rollBack();
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast',$toast);
        }
    }

    public function search(Request $request)
    {
        try {
            $key_word = $request->get('keyword');
            $filters  = ['keyword'=>$key_word] ;
            $receivers = app()->make(ReceiverService::class)->receiverQueryBuilder(filters: $filters,withRelations: ['city','area','branch:id,name'])->limit(15)->get();
            return apiResponse(data: $receivers ,code: 200);
        }catch (Exception $exception)
        {
            dd($exception);
            return apiResponse(message: $exception->getMessage(),code: 500);
        }
    }
}
