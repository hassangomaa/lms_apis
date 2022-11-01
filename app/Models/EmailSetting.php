<?php

namespace App\Models;

use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class EmailSetting extends Model
{
    use Tenantable;

    protected $guarded = ['id'];
    protected $fillable = [];
}
