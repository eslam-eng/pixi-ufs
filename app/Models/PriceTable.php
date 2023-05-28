<?php

namespace App\Models;

use App\Traits\EscapeUnicodeJson;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceTable extends Model
{
    use HasFactory , Filterable , EscapeUnicodeJson;

    protected $fillable = [
        'company_id','location_from','location_to',
        'price','basic_kg', 'additional_kg_price',
        'return_price', 'special_price'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function locationFrom()
    {
        return $this->belongsTo(Location::class,'location_from');
    }


    public function locationTo()
    {
        return $this->belongsTo(Location::class,'location_to');
    }
}
