<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AwbHistory extends Model
{
    use HasFactory,SoftDeletes,LogsActivity;
    protected $fillable = [
        'awb_id','user_id','awb_status_id','comment','lat','lng'
    ];

    public function awb()
    {
        return $this->belongsTo(Awb::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(AwbStatus::class, 'awb_status_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('awbs')
            ->logOnly([
                'awb_id', 'user.id','user.name',
                'awb_status_id','status.name',
                'comment','lat','lng'
            ])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} Awb history");
    }
}
