<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Page extends Model
{


    protected $fillable = [];

    public function user(){

        return $this->belongsTo(User::class,'user_id','id');
    }

    public function course(){

        $this->belongsTo(Course::class,'course_id');
    }
}
