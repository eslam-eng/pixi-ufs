<?php

namespace App\Models;

use App\Enums\ActivationStatus;
use App\Traits\Filterable;
use App\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Receiver extends Model
{
    use HasFactory, HasAddresses, Filterable;

    protected $guarded = 'id';
    protected $fillable = [
        'name', 'phone1','phone2',
        'receiving_company', 'company_id', 'branch_id',
        'address1', 'address2', 'city_id', 'area_id','lat','lng',
        'reference', 'title', 'status', 'notes'
    ];

    public function defaultAddress(): MorphOne
    {
        return $this->MorphOne(Address::class, 'addressable')->where('is_default', ActivationStatus::ACTIVE())->with('city','area');
    }

    public function city()
    {
        return $this->belongsTo(Location::class,'city_id');
    }


    public function area()
    {
        return $this->belongsTo(Location::class,'area_id');
    }
    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function getCompanyNameAttribute()
    {
        return $this->relationLoaded('branch') && $this->branch->relationLoaded('company') && isset($this->branch->company) ? $this->branch->company->name : null;
    }

    public function getBranchNameAttribute()
    {
        return $this->relationLoaded('branch') && isset($this->branch) ? $this->branch->name : null;
    }

    public function getAddressNameAttribute()
    {
        return $this->relationLoaded('defaultAddress') && isset($this->defaultAddress) ? $this->defaultAddress->address : null;
    }
}
