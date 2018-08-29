<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'customer_name', 'customer_address', 'customer_phone', 'customer_mail', 
        'customer_admin', 'enable', 'created_at', 'updated_at', 'deleted_at',
    ];


   
    public function users()
    {
        return $this->hasMany('App\User');
    }
   
    public function readers()
    {
        return $this->hasMany('App\Merchant');
    }

    public function branchOffices()
    {
        return $this->hasMany('App\BrancOffice');
    }

    public function merchants()
    {
        return $this->hasMany('App\Merchant');
    }

    public function countries()
    {
        return belongsToMany('App\Country');
    }


}
