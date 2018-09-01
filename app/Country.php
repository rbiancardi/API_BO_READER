<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    protected $table = "countries";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'name', 'enable', 'created_at', 'updated_at', 'deleted_at',
    ];



    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'country_customer', 'country_id', 'customer_id' );
    }

    public function provincies()
    {
        return $this->hasMany('App\Province');
    }

    public function counties()
    {
        return $this->hasMany('App\County');
    }

    public function localities()
    {
        return $this->hasMany('App\Locality');
    }

    


}//Fin de la clase
