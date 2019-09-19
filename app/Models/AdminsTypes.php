<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminsTypes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function admins(){
        $this->hasMany('App\Admin');
    }
}
