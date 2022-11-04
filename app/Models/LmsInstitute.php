<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Models\SaasCheckout;
use App\Models\SaasInstitutePlanManagement;

use App\Models\SaasCheckout as MDSaasCheckout;
use App\Models\SaasInstitutePlanManagement as MDSaasInstitutePlanManagement;
use App\Model\GeneralSetting;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LmsInstitute extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function settings()
    {
        $settings = DB::table('general_settings')->where('lms_id', $this->id)->pluck('value', 'key');
        $settings['country_name'] = DB::table('countries')->where('id', $settings['country_id'])->first()->name ?? '';
        return $settings;
    }

    public function plan_management()
    {
        if (isModuleActive('LmsSaasMD')) {
            return $this->belongsTo(MDSaasInstitutePlanManagement::class, 'id', 'lms_id')->withDefault();
        } else {
            return $this->belongsTo(SaasInstitutePlanManagement::class, 'id', 'lms_id')->withDefault();
        }
    }

    public function saas_checkout()
    {
        if (isModuleActive('LmsSaasMD')) {
            return $this->hasMany(MDSaasCheckout::class, 'lms_id')->orderBy('id', 'desc');
        } else {
            return $this->hasMany(SaasCheckout::class, 'lms_id')->orderBy('id', 'desc');
        }
    }
}
