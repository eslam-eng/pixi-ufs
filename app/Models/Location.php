<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Location extends Model
{
    use HasFactory,NodeTrait,Filterable;
    protected $fillable = [
        'title' ,'status', 'lft' ,'rgt','_lft','_lft','parent_id'
    ];
}
