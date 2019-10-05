<?php
namespace App;

use SMartins\PassportMultiauth\HasMultiAuthApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasMultiAuthApiTokens, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'pos'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setActiveAttribute($value){
        if($value == 'false') $this->attributes['active'] = 0;
        else $this->attributes['active'] = 1;
    }

    public function getActiveAttribute($value){
        if($value) return true;
        return false;
    }

    public function types(){
        return $this->belongsTo('App\Models\UsersTypes');
    }

}
