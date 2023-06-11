<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDatatable;
use App\Http\Requests\Users\UserStoreRequest;
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
    public function index(UsersDatatable $usersDatatable , Request $request)
    {
        try {
            $filters = array_filter($request->get('filters', []), function ($value) {
                return ($value !== null && $value !== false && $value !== '');
            });
            $withRelations = ['city','area','branch', 'company'];
            return $usersDatatable->with(['filters'=>$filters,'withRelations'=>$withRelations])->render('layouts.dashboard.users.index');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $permissions = Permission::all();
            $permissions = $permissions->groupBy('category');
            return view('layouts.dashboard.users.create', compact('permissions'));
        }catch(Exception $e){
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $this->userService->store($request->toUserDTO());
            return redirect()->route('users.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = $this->userService->findById(id: $id);
            $permissions = Permission::all();
            $permissions = $permissions->groupBy('category');
            return view('layouts.dashboard.users.show', compact('user', 'permissions'));
        }catch(Exception $e){
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $user = $this->userService->findById(id: $id);
            $permissions = Permission::all();
            $permissions = $permissions->groupBy('category');
            return view('layouts.dashboard.users.edit', compact('user', 'permissions'));
        }catch(Exception $e){
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $userDTO = $request->toUserDTO();
            $this->userService->update($userDTO, $id);
            return redirect()->route('users.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->userService->destroy(id: $id);
            return redirect()->route('users.index');
        }catch (Exception $e) {
            return redirect()->back();
        }
    }
}
