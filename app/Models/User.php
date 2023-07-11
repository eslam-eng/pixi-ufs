<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Filterable;
use App\Traits\HasAddresses;
use App\Traits\HasAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, Filterable,HasApiTokens,
        HasFactory, Notifiable,HasRoles,
        HasAddresses, HasAttachment;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'type', 'status',
        'company_id', 'department_id', 'branch_id', 'notes',
        'device_token','address','city_id','area_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getToken(): string
    {
        return $this->createToken(config('app.name'))->plainTextToken;
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function getShowDashboardAttribute(): bool
    {
        return $this->relationLoaded('company') && $this->company->show_dashboard;
    }

    public function attachments()
    {
        return $this->morphOne(Attachment::class,'attachmentable');
    }

    public function city()
    {
        return $this->belongsTo(Location::class,'city_id');
    }


    public function area()
    {
        return $this->belongsTo(Location::class,'area_id');
    }

    public function getProfileImageAttribute()
    {
        return isset($this->attachments) ?
             $this->attachments()->where('field_name', 'profile_image')->first()->path.'/'.$this->attachments()->where('field_name', 'profile_image')->first()->file_name
        : 'assets/images/default-image.jpg';
        
    }

}
