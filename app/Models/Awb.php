<?php

namespace App\Models;

use App\Observers\AwbObserver;
use App\Traits\EscapeUnicodeJson;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Awb extends Model
{
    use HasFactory, Filterable, EscapeUnicodeJson, SoftDeletes;

    protected $fillable = [
        'code', 'user_id','company_id' ,'branch_id',
        'department_id', 'receiver_id','receiver_reference',
        'receiver_data', 'payment_type', 'service_type', 'is_return', 'shipment_type',
        'zone_price', 'additional_kg_price', 'collection', 'weight',
        'pieces', 'actual_recipient','card_number','title'
    ];

    protected $casts = [
        'receiver_data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    public function history()
    {
        return $this->hasMany(AwbHistory::class, 'awb_id');
    }

    public function additionalInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AwbAdditionalInfo::class, 'awb_id');
    }

    public function latestStatus()
    {
        return $this->hasOne(AwbHistory::class, 'awb_id')->latestOfMany();
    }

    public function getReceiverAddressAttribute(): string
    {
        return Str::limit(Arr::get($this->receiver_data,'address'),90);
    }

    protected static function boot()
    {
        parent::boot();

        static::observe(AwbObserver::class);
    }

}
