<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Course;
use App\Models\Lession;
use Rennokki\QueryCache\Traits\QueryCacheable;

class BookmarkCourse extends Model
{


    protected $fillable = [];

    protected $appends =['bookmarkDate'];

    public function course()
    {
    	return $this->belongsTo(Course::class)->withDefault();
    }

    public function user()
    {
    	return $this->belongsTo(User::class)->withDefault();
    }

    public function lesson()
    {
        return $this->belongsTo(Lession::class)->withDefault();
    }

    public function getbookmarkDateAttribute()
    {
        return Carbon::parse($this->created_at)->isoformat('Do MMMM Y');
    }
}
