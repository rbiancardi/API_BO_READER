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
        'id', 'customer_name', 'customer_address', 'customer_phone', 'customer_email', 
        'customer_admin', 'user_creator', 'enable', 'created_at', 'updated_at', 'updated_by', 'deleted_at',
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
        return $this->belongsToMany('App\Country', 'country_customer', 'customer_id', 'country_id');
    }

    public function provincies()
    {
        return $this->belongsToMany('App\Province', 'customer_province', 'customer_id', 'province_id');
    }

    public function counties()
    {
        return $this->belongsToMany('App\County', 'county_customer', 'customer_id', 'county_id');
    }

    public function localities()
    {
        return $this->belongsToMany('App\Locality', 'customer_locality', 'customer_id', 'locality_id');
    }




}
