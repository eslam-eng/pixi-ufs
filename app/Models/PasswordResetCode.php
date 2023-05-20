<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'identifier',
        'code',
        'created_at',
    ];

    public function isExpire(): void
    {
        if ($this->created_at > now()->addMinutes(30)) {
            $this->delete();
        }
    }
}
