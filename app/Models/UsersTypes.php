<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersTypes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function users(){
        $this->hasMany('App\User');
    }
}
