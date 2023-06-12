<?php

namespace App\Models;

use App\Enums\ActivationStatus;
use App\Traits\Filterable;
use App\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Branch extends Model
{
    use HasFactory, Filterable,LogsActivity;
    protected $table = 'branches';
    protected $fillable = ['name','company_id','address','city_id','area_id','phone', 'status'];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function getCompanyNameAttribute()
    {
        return $this->relationLoaded('company') ? $this->company->name : null;
    }

    public function city(){
        return $this->belongsTo(Location::class,'city_id');
    }


    public function area(){
        return $this->belongsTo(Location::class,'area_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('companies')
            ->logOnly([
                'name','company_id','address',
                'city_id','area_id','city.title','area.title',
                'phone', 'status'
            ])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} branch");
    }
}
