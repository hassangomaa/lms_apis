<?php

namespace App\Models;

use App\Traits\Tenantable;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ShowRoom;
use App\Models\WareHouse;
use App\Models\Payroll;
use App\Models\Department;
use App\Models\IntroPrefix;

class Staff extends Model
{
    use Tenantable;

    use SoftDeletes;
    protected $table = 'staffs';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(\Modules\SystemSetting\Entities\Department::class)->withDefault();
    }

    public function payrolls(){
        return $this->hasMany(\Modules\HumanResource\Entities\Payroll::class, 'staff_id', 'id');
    }
}
