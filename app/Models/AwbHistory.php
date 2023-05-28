<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwbHistory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['awb_id','user_id','awb_status_id','comment'];

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
}
