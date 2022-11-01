<?php

namespace App\Models;

use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Models\FooterContent;

class FooterCategory extends Model
{
    use Tenantable;

    protected $fillable = ['title','description','placeholder'];

    public function contents()
    {
        return $this->hasMany(FooterContent::class);
    }
}
