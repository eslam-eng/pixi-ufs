<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, Filterable;
    protected $fillable = ['name','company_id'] ;

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function getCompanyNameAttribute()
    {
        return $this->relationLoaded('company') ? $this->company->name : null;
    }
}
