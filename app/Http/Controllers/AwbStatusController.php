<?php

namespace App\Http\Controllers;

use App\DataTables\AwbStatusDataTable;
use App\Exceptions\NotFoundException;
use App\Http\Requests\AwbStatus\AwbStatusStoreRequest;
use App\Http\Requests\AwbStatus\AwbStatusStoreRequest as AwbStatusUpdateRequest;
use App\Services\AwbStatusService;
use Exception;
use Illuminate\Http\Request;

class AwbStatusController extends Controller
{
    public function __construct(protected AwbStatusService $awbStatusService)
    {

    }

    /**
     * get all receivers
     */
    public function index(AwbStatusDataTable $awbStatusDataTable, Request $request)
    {
        try {
            $filters = array_filter($request->get('filters', []), function ($value) {
                return ($value !== null && $value !== false && $value !== '');
            });
            return $awbStatusDataTable->with(['filters' => $filters])->render('layouts.dashboard.awb-status.index');
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    public function create()
    {
        return view('layouts.dashboard.awb-status.create');
    }

    public function store(AwbStatusStoreRequest $request)
    {
        try {
            $awbStatusDTO = $request->toAwbStatusDTO();
            $this->awbStatusService->store($awbStatusDTO);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.success_operation')
            ];
            return redirect()->route('awb-status.index')->with('toast', $toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }


    public function edit(int $id)
    {
        try {
            $awbStatus = $this->awbStatusService->findById(id: $id);
            return view('layouts.dashboard.awb-status.edit', ['awbStatus' => $awbStatus]);
        } catch (Exception|NotFoundException $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $exception->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    public function update(AwbStatusUpdateRequest $request, int $id)
    {
        try {
            $awbStatusDTO = $request->toAwbStatusDTO();
            $this->awbStatusService->update($id, $awbStatusDTO);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.success_operation')
            ];
            return redirect()->route('awb-status.index')->with('toast', $toast);
        } catch (Exception|NotFoundException $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    /**
     * delete existing receiver
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            $this->awbStatusService->destroy(id: $id);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }

}
