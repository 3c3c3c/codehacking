<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Photo;
use App\Role;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'is_active', 'photo_id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //each user has an assigned role found in the role table 
    public function role(){
        return $this->belongsTo('App\Role');
    }

    //a user can have (optional) a photo assigned to them
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

}
