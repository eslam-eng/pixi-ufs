<?php

namespace App\Models;

use App\Enums\ActivationStatus;
use App\Traits\Filterable;
use App\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use HasFactory, Filterable,LogsActivity;

    protected $fillable = [
        'name', 'email','ceo', 'phone', 'show_dashboard',
        'num_custom_fields', 'notes', 'status',
        'importation_type','address','city_id','area_id'
    ];


    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
    public function city(): BelongsTo
    {
        return $this->BelongsTo(Location::class);
    }
    public function area(): BelongsTo
    {
        return $this->BelongsTo(Location::class);
    }

    public function scopeSearch($builder, $term)
    {
        return $builder->where('name', 'LIKE', $term)->orWhere('phone', 'LIKE', $term);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('companies')
            ->logOnly([
                'name', 'email','ceo', 'phone', 'show_dashboard',
                'num_custom_fields', 'notes', 'status',
                'importation_type','address','city_id','area_id','city.title','area.title'
            ])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} company");
    }
}
