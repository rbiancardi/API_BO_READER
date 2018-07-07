<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    
    protected $table = "currencies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'iso_4217','currency_name', 'currency_country',
         'enable', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'currency_product')//, 'currency_id', 'id')
            ->withTimestamps();
    }

}
