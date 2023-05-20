<?php

namespace App\Models;

use App\Enums\ImportLogEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    use HasFactory;
    protected $fillable = ['import_type','total_count','failed_count','errors','status_id','created_by'];

    public $casts = [
        'errors'=>'array'
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class,'created_by');
    }

    public function getCreatedNameAttribute()
    {
        return $this->relationLoaded('company') ? $this->company->name : null ;
    }

    public function getStatusTextAttribute(): string
    {
        return ImportLogEnum::from($this->status_id)->name;
    }
}
