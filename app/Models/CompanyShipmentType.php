<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyShipmentType extends Model
{
    use HasFactory,Filterable;

    protected $fillable = ['company_id','name','fixed_weight', 'has_dimension'];
}
