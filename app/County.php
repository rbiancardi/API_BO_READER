<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $table = "counties";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id','countryId', 'provinceId' ,'name', 'enable', 'created_at', 'updated_at'
    ];


    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'county_customer', 'county_id', 'customer_id');
    }

    public function countries()
    {
        return $this->belongsTo('App\Country', 'countryId', 'id');
    }

    public function provincies()
    {
        return $this->belongsTo('App\Province', 'provinceId', 'id');
    }

    public function localities()
    {
        return $this->hasMany('App\Locality', 'countyId', 'id');
    }

}
