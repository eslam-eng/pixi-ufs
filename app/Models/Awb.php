<?php

namespace App\Models;

use App\Enums\AwbStatuses;
use App\Enums\UsersType;
use App\Observers\AwbObserver;
use App\Traits\EscapeUnicodeJson;
use App\Traits\Filterable;
use App\Traits\HasAttachment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Awb extends Model
{
    use HasFactory, Filterable, EscapeUnicodeJson, SoftDeletes, HasAttachment, LogsActivity;

    protected $fillable = [
        'code', 'user_id', 'company_id', 'branch_id', 'receiver_city_id', 'receiver_area_id',
        'department_id', 'receiver_id', 'receiver_reference',
        'receiver_data', 'payment_type', 'service_type', 'is_return', 'shipment_type',
        'zone_price', 'additional_kg_price', 'collection', 'weight',
        'pieces', 'actual_recipient', 'card_number', 'title'
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

    public function receiverArea()
    {
        return $this->belongsTo(Location::class, 'receiver_area_id');
    }

    public function receiverCity()
    {
        return $this->belongsTo(Location::class, 'receiver_city_id');
    }

    public function history()
    {
        return $this->hasMany(AwbHistory::class, 'awb_id');
    }

    public function dimension(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AwbDetail::class, 'awb_id');
    }

    public function additionalInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AwbAdditionalInfo::class, 'awb_id');
    }

    public function latestStatus()
    {
        return $this->hasOne(AwbHistory::class, 'awb_id')->latestOfMany();
    }

    public function getAwbReceiverDataAttribute(){
        return Arr::first($this->receiver_data);
    }

    public function getReceiverAddressAttribute()
    {
        return Str::limit(Arr::get($this->awb_receiver_data, 'address1'), 90);
    }


    public function scopeCourier(Builder $builder, $auth_user = null): Builder
    {
        if (is_null($auth_user))
            $auth_user = auth()->user();
        if ($auth_user->type != UsersType::COURIER->value)
            return $builder;
        return $builder->whereIn('area_id', $auth_user->area_id)->whereHas('latestStatus', fn($query) => $query->where('awb_status_id', AwbStatuses::CREATE_SHIPMENT()));

    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('awbs')
            ->logOnly([
                'user.id', 'user.name', 'payment_type', 'service_type', 'is_return', 'shipment_type',
                'zone_price', 'additional_kg_price', 'collection', 'weight',
                'pieces', 'actual_recipient', 'card_number', 'title'
            ])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Awb");
    }

    protected static function boot()
    {
        parent::boot();

        static::observe(AwbObserver::class);
    }

}
