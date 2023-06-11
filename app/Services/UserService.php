<?php

namespace App\Services;

use App\DTO\User\UserDTO;
use App\Models\User;
use App\QueryFilters\UsersFilters;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class UserService extends BaseService
{

    public function __construct(private User $model)
    {
        
    }

    public function getModel(): Model
    {
        return $this->model;
    }

     //method for api with pagination
     public function listing(array $filters = [], array $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
     {
         return $this->queryGet(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
     }
 
     public function queryGet(array $filters = [], array $withRelations = []): builder
     {
         $users = $this->getQuery()->with($withRelations);
         return $users->filter(new UsersFilters($filters));
     }

     public function datatable(array $filters = [] , array $withRelations = []): Builder
    {
        return $this->queryGet(filters: $filters , withRelations: $withRelations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserDTO $userDTO)
    {
        $user = $this->getModel()->create($userDTO->toArray());
        if($user)
            $user->givePermissionTo(Arr::get($userDTO->toArray(), 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserDTO $userDTO, $id)
    {
        $user = $this->findById($id);
        $user->update($userDTO->toArray());
        $user->syncPermissions(Arr::get($userDTO->toArray(), 'permissions'));
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->findById($id);
        $user->delete();
        return true;
    }
}
