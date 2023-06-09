<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDatatable;
use App\Enums\UsersType;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateProfileRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
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
            $permissions = [];
            $user = $this->userService->findById(id: $id);
            if ($user->type == UsersType::SUPERADMIN->value)
                $permissions = config('permissions.super_admin');
            if ($user->type == UsersType::ADMIN->value)
                $permissions = config('permissions.company');
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
}
