<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','role_name', 'role_description', 'enable', 'created_at', 'updated_at', 'deleted_at'
    ];



        public function users()
        {
            return $this->hasMany('App\User');
        }

        public function permissions()
        {
            return $this->hasMany('App\Permission');
        }



}
