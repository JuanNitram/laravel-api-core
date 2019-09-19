<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Subcategories extends Model
{
    protected $table = 'subcategories';

    protected $fillable = [
        'name', 'categories_id', 'active', 'pos'
    ];

    public function setActiveAttribute($value){
        if($value == 'false') $this->attributes['active'] = 0;
        else $this->attributes['active'] = 1;
    }

    public function getActiveAttribute($value){
        if($value) return true;
        return false;
    }

    public function categories(){
        return $this->belongsTo('App\Models\Categories');
    }

    public function products(){
        return $this->hasMany('App\Models\Products');
    }

}
