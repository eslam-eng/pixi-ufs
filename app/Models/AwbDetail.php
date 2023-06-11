<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwbDetail extends Model
{
    use HasFactory;

    protected $fillable = ['height','width','length','awb_id'];

    public function awb()
    {
        return $this->belongsTo(Awb::class);
    }




}
