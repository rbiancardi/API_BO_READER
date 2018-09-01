<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $table = "localities";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id','countryId', 'provinceId', 'countyId', 'name', 'enable', 'created_at', 'updated_at'
    ];


    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'customer_locality', 'locality_id', 'customer_id');
    }

    public function countries()
    {
        return $this->belongsTo('App\Country', 'countryId', 'id');
    }

    public function provincies()
    {
        return $this->belongsTo('App\Province', 'provinceId', 'id');
    }

    public function counties()
    {
        return $this->belongsTo('App\County', 'countyId', 'id');
    }

}
