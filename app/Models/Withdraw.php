<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Withdraw extends Model
{
use Tenantable;

    protected $fillable = ['instructor_id', 'method', 'status', 'issueDate', 'amount'];


    protected $appends = ['invoiceDate', 'issueDateFormat'];

    public function user()
    {

        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function getinvoiceDateAttribute()
    {
        return Carbon::parse($this->created_at)->isoformat('Do MMMM Y');
    }

    public function getissueDateFormatAttribute()
    {
        return Carbon::parse($this->issueDate)->isoformat('Do MMMM Y');
    }
}
