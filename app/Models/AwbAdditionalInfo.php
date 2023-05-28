<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwbAdditionalInfo extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'awb_id', 'custom_field1', 'custom_field2', 'custom_field3',
        'custom_field4', 'custom_field5',
        'custom_field6', 'custom_field7', 'custom_field8',
        'custom_field9', 'custom_field10'];

    public function Awb()
    {
        return $this->belongsTo(Awb::class);
    }
}
