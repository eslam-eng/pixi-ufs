<?php

namespace App\Models;

use App\Enums\ImportStatusEnum;
use App\Enums\ImportTypeEnum;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    use HasFactory,Filterable;
    protected $fillable = ['import_type','total_count','success_count','errors','status_id','created_by'];

    public $casts = [
        'errors'=>'array'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }


    public function getStatusTextAttribute(): string
    {
        return trans('app.'.ImportStatusEnum::from($this->status_id)->name);
    }

    public function getImportTypeTextAttribute(): string
    {
        return trans('app.'.ImportTypeEnum::from($this->import_type)->name);
    }
}
