<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    protected $guarded = [
        ''
    ];

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $value;
        $this->attributes['guid'] = (string) Str::orderedUuid();
    }

    public function propertyAnalytics()
    {
        return $this->hasMany('App\Models\PropertyAnalytic');
    }
}
