<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Chapter extends Model
{


    protected $fillable = [];

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'chapter_id', 'id')->orderBy('position');
    }
}
