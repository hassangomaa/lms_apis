<?php

namespace App\Models;

use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Subscriber extends Model
{

use Tenantable;
    protected $fillable = [];

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
}
