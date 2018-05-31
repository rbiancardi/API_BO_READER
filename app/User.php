<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table ="users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_name', 'email', 'password', 'name', 'last_name', 'user_type_id',
        'role_id', 'enable', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


        public function merchants()
        {
            return $this->belongsToMany('App\Merchant');
        }

        public function userTypes()
        {
            return $this->belongsTo('App\UserType', 'user_type_id');
        }

        public function roles()
        {
            return $this->belongsTo('App\Role', 'role_id');
        }

}
