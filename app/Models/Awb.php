<?php

namespace App\Models;

use App\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Awb extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'code','user_id','branch_id',
        'department_id','receiver_id',
        'receiver_data','payment_type','service_type','is_return','shipment_type',
        'zone_price','additional_kg_price','collection','weight',
        'pieces','actual_recipient'
    ];

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => time(),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function latestStatus()
    {
        return $this->hasOne(AwbHistory::class, 'awb_id')->latestOfMany();
    }
}
