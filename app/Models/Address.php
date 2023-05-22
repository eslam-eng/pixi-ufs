<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['addressable_type','addressable_id' , 'lat','lng','address','map_url','city_id','area_id','postal_code','is_default'];

    public function addressable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class, 'city_id');
    }

    public function area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Location::class, 'area_id');
    }

    public function getAreaNameAttribute()
    {
        return $this->relationLoaded('area') && isset($this->area) ? $this->area->title : null;
    }

    public function getCityNameAttribute()
    {
        return $this->relationLoaded('city') && isset($this->city) ? $this->city->title : null;
    }

}
