<?php

namespace App\Models;

use App\Traits\Tenantable;
use Illuminate\Support\Str;
use App\Models\BbbMeeting;
use App\Models\ZoomMeeting;
use Illuminate\Database\Eloquent\Model;
use App\Models\JitsiMeeting;
use App\Notifications\GeneralNotification;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Support\Facades\Notification;
use App\Models\Category;
use Spatie\Translatable\HasTranslations;

class VirtualClass extends Model
{
    use Tenantable;

    protected $guarded = [];

    use HasTranslations;

    public $translatable = ['title'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id')->withDefault(
            [
                'name' => ''
            ]
        );
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id')->withDefault();
    }

    public function zoomMeetings()
    {
        return $this->hasMany(ZoomMeeting::class, 'class_id')->orderBy('start_time', 'asc');
    }

    public function bbbMeetings()
    {
        return $this->hasMany(BbbMeeting::class, 'class_id')->orderBy('datetime', 'asc');
    }

    public function jitsiMeetings()
    {
        return $this->hasMany(JitsiMeeting::class, 'class_id')->orderBy('datetime', 'asc');
    }

    public function totalClass()
    {
        $total = 0;
        if ($this->host == "Zoom") {
            $total = count($this->zoomMeetings);
        } elseif ($this->host == "BBB") {
            $total = count($this->bbbMeetings);
        } elseif ($this->host == "Jitsi") {
            $total = count($this->jitsiMeetings);
        }
        return $total;
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'class_id')->withDefault();
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->title) == "" ? str_replace(' ', '-', $this->title) : Str::slug($this->title);

    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            saasPlanManagement('meeting', 'create');
        });

        static::deleting(function ($virtualClass) {
            saasPlanManagement('meeting', 'delete');
            $receivers = $virtualClass->course->enrollUsers;
            $message = "Your virtual class " . $virtualClass->title . " has been deleted";
            foreach ($receivers as $key => $receiver) {
                $details = [
                    'title' => 'Virtual Class Deleted ',
                    'body' => $message,
                    'actionText' => '',
                    'actionURL' => '',
                ];
                Notification::send($receiver, new GeneralNotification($details));
            }
        });

    }


}
