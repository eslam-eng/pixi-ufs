<?php

namespace App\Models;

use App\Enums\ActivationStatus;
use App\Traits\Filterable;
use App\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Company extends Model
{
    use HasFactory, HasAddresses, Filterable;

    protected $fillable = ['name', 'email','ceo', 'phone', 'show_dashboard', 'notes', 'status'];


    public function addresses(): MorphOne
    {
        return $this->MorphOne(Address::class, 'addressable')->where('is_default', ActivationStatus::ACTIVE());
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function scopeSearch($builder, $term)
    {
        return $builder->where('name', 'LIKE', $term)->orWhere('phone', 'LIKE', $term);
    }

}
