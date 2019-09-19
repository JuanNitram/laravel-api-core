<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Products extends BaseModel
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'description','description_quill',
        'currency', 'price', 'sale_currency', 'sale_price',
        'categories_id', 'highlighted', 'active', 'pos'
    ];

    public function setActiveAttribute($value){
        if($value == 'false') $this->attributes['active'] = 0;
        else $this->attributes['active'] = 1;
    }

    public function getActiveAttribute($value){
        if($value) return true;
        return false;
    }

    public function setHighlightedAttribute($value){
        if($value == 'false') $this->attributes['highlighted'] = 0;
        else $this->attributes['highlighted'] = 1;
    }

    public function getHighlightedAttribute($value){
        if($value) return true;
        return false;
    }

    public function categories(){
        return $this->belongsTo('App\Models\Categories');
    }

    public function subcategories(){
        return $this->belongsToMany('App\Models\Subcategories', 'products_subcategories', 'products_id', 'subcategories_id');
    }

}
