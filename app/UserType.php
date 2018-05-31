<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table ="user_types";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'enable', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

}
