<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Sliders extends BaseModel
{
    protected $table = 'sliders';

    protected $fillable = [
        'title', 'subtitle', 'url', 'active' ,'pos'
    ];

    public function setActiveAttribute($value){
        if($value == 'false') $this->attributes['active'] = 0;
        else $this->attributes['active'] = 1;
    }

    public function getActiveAttribute($value){
        if($value) return true;
        return false;
    }

}
