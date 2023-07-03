<?php

namespace App\Services;

use App\DTO\User\UserDTO;
use App\Enums\AttachmentsType;
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
        $data = $userDTO->toArray();
        $user = $this->getModel()->create(Arr::except($data, 'profile_image'));
        if (isset($data['profile_image']))
        {
            $fileData = FileService::saveImage(file: $data['profile_image'],path: 'uploads/users', field_name: 'profile_image');
            $fileData['type'] = AttachmentsType::PRIMARYIMAGE;
            $user->storeAttachment($fileData);
        }
        if($user)
            $user->givePermissionTo(Arr::get($data, 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return true
     */
    public function update(UserDTO $userDTO, $id)
    {
        $user = $this->findById($id);
        $data = $userDTO->toArray();
        if(!isset($data['password']))
            $user->update(Arr::except($data, ['profile_image', 'password']));
        else
            $user->update(Arr::except($data, 'profile_image'));

        if (isset($data['profile_image']))
        {
            $user->deleteAttachmentsLogo();
            $fileData = FileService::saveImage(file: $data['profile_image'],path: 'uploads/users', field_name: 'profile_image');
            $fileData['type'] = AttachmentsType::PRIMARYIMAGE;
            $user->storeAttachment($fileData);
        }
        $user->syncPermissions(Arr::get($data, 'permissions'));
        return true;
    }

    public function updateProfile(array $data = [], $id)
    {
        $user = $this->findById($id);
        if(!isset($data['password']))
            $user->update(Arr::except($data, ['profile_image', 'password']));
        else{
            $data['password'] = bcrypt($data['password']);
            $user->update(Arr::except($data, 'profile_image'));
        }

        if (isset($data['profile_image']))
        {
            $user->deleteAttachmentsLogo();
            $fileData = FileService::saveImage(file: $data['profile_image'],path: 'uploads/users', field_name: 'profile_image');
            $fileData['type'] = AttachmentsType::PRIMARYIMAGE;
            $user->storeAttachment($fileData);
        }
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
        $user->deleteAttachments();
        $user->delete();
        return true;
    }
}
