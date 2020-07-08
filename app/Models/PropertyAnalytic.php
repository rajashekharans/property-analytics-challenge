<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;

class PropertyAnalytic extends Model
{
    protected $guarded = [
        ''
    ];

    public function properties()
    {
        $this->belongsTo('App\Models\Property');
    }

    public function analyticTypes()
    {
        $this->belongsTo('App\Models\AnalyticType');
    }
}
