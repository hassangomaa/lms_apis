<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Package extends Model
{


    protected $fillable = [];

    protected $casts = [
        'courses' => 'object',

    ];
}
