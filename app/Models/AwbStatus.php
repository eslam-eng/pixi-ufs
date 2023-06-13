<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwbStatus extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['name', 'is_final', 'stepper', 'code','description','type', 'sms'];
}
