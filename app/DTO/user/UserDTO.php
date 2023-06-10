<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class UserDTO extends BaseDTO
{

    /**
     * @param string $name',
     * @param string $email',
     * @param string $password',
     * @param string $phone',
     * @param int $type',
     * @param int $status',
     * @param ?int $company_id',
     * @param ?int $branch_id',
     * @param ?int $department_id',
     * @param ?string $notes'
     */
    public function __construct(
        protected string $name,
        protected string $email,
        protected string $password,
        protected string $phone,
        protected int $type,
        protected int $status,
        protected int $company_id,
        protected int $branch_id,
        protected int $department_id,
        protected string $notes,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password,
            phone: $request->phone,
            type: $request->type,
            status: $request->status,
            company_id: $request->company_id,
            branch_id: $request->branch_id,
            department_id: $request->department_id,
            notes: $request->notes,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            name: Arr::get($data,'name'),
            email: Arr::get($data,'email'),
            password: Arr::get($data,'password'),
            phone: Arr::get($data,'phone'),
            type: Arr::get($data,'type'),
            status: Arr::get($data,'status'),
            company_id: Arr::get($data,'company_id'),
            branch_id: Arr::get($data,'branch_id'),
            department_id: Arr::get($data,'department_id'),
            notes: Arr::get($data,'notes'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'type' => $this->type,
            'status' => $this->status,
            'company_id' => $this->company_id,
            'branch_id' => $this->branch_id,
            'department_id' => $this->department_id,
            'notes' => $this->notes,

        ];
    }

}
