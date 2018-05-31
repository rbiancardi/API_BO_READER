<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table ="permissions";
    
    protected $fillable = [
        'id','role_id', 'permission_name', 'permission_description',
        'enable', 'created_at', 'updated_at', 'deleted_at'
    ];

    
        public function roles()
        {
            return $this->belongsTo('App\Role', 'role_id');
        }


}
