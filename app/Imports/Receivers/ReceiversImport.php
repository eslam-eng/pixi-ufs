<?php

namespace App\Imports\Receivers;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReceiversImport implements WithMultipleSheets
{
    use Importable;


    public function __construct(public User $auth_user)
    {
    }

    public function sheets(): array
    {
        return [
            'receivers' => new ReceiversImportSheet($this->auth_user),
        ];
    }
}
