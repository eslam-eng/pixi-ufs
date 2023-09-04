<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDatatable;
use App\Enums\ImportTypeEnum;
use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateProfileRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Imports\Users\UsersImport;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{

    public function __construct(private UserService $userService)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDatatable $usersDatatable, Request $request)
    {
        try {
            $user = getAuthUser();
            $filters = array_filter($request->get('filters', []), function ($value) {
                return ($value !== null && $value !== false && $value !== '');
            });
            if ($user->type != UsersType::SUPERADMIN())
                $filters['company_id'] = $user->company_id;
            if ($user->type == UsersType::EMPLOYEE())
                $filters['branch_id'] = $user->branch_id;
            $withRelations = ['city', 'area', 'branch', 'company'];
            return $usersDatatable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.users.index');
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        try {
            $user = getAuthUser();
            $permissions = [];
            if ($user->type == UsersType::SUPERADMIN->value)
                $permissions = config('permissions.super_admin');
            if ($user->type == UsersType::ADMIN->value)
                $permissions = config('permissions.company');
            return view('layouts.dashboard.users.create', compact('permissions'));
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast',$toast);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $this->userService->store($request->toUserDTO());
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.user_created_successfully')
            ];
            return redirect()->route('users.index')->with('toast',$toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast',$toast);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        try {
            $user = $this->userService->findById(id: $id, withRelations: ['attachments']);
            $permissions = Permission::all();
            $permissions = $permissions->groupBy('group_name');
            return view('layouts.dashboard.users.show', compact('user', 'permissions'));
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast',$toast);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
//            $permissions = [];
            $user = $this->userService->findById(id: $id);
//            if ($user->type == UsersType::SUPERADMIN->value)
                $permissions = config('permissions.super_admin');
//            if ($user->type == UsersType::ADMIN->value)
//                $permissions = config('permissions.company');
            return view('layouts.dashboard.users.edit', compact('user', 'permissions'));
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $userDTO = $request->toUserDTO();
            $this->userService->update($userDTO, $id);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.user_created_successfully')
            ];
            return to_route('users.index')->with('toast',$toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast',$toast);
        }
    }
    public function updateProfile(UserUpdateProfileRequest $request, $id)
    {
        try {
            $this->userService->updateProfile($request->validated(), $id);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.success_operation')
            ];
            return to_route('home')->with('toast',$toast);
        } catch (Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast',$toast);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->userService->destroy(id: $id);
            return apiResponse(message: trans('lang.success_operation'));
        } catch (NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code: 422);
        } catch (Exception $e) {
            return apiResponse(message: trans('lang.something_went_wrong'), code: 422);
        }
    }


    public function importForm()
    {
        return view('layouts.dashboard.users.importation.form');
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function downloadUsersTemplate()
    {
        $file_path = public_path('/ExcelTemplate/Users/UsersExcelTemplate.xlsx');
        return response()->download($file_path);
    }

    public function import(FileUploadRequest $request)
    {
        try {
            DB::beginTransaction();
            $file = $request->file('file');
            $user = getAuthUser();
            $importation_type = ImportTypeEnum::USERS->value;
            $importObject = new UsersImport( creator: $user,importation_type: $importation_type);
            $importObject->import($file);
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

}
