<?php

namespace App\Models;

use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class InstructorPayout extends Model
{
use Tenantable;

    protected $fillable = [];
}
