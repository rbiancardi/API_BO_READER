<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
 
    protected $table = "provinces";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id','countryId' ,'name', 'enable', 'created_at', 'updated_at'
    ];



    public function customers()
    {
        return $this->belongsToMany('App\Customer');
    }

    public function countries()
    {
        return $this->belongsTo('App\Country');
    }

    public function counties()
    {
        return $this->hasMany('App\County', 'provinceId', 'id');
    }

    public function localities()
    {
        return $this->hasMany('App\Locality');
    }


}
