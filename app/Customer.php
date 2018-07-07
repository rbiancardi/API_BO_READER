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


    public function merchants()
    {
        return $this->hasMany('App\Merchant');
    }



}
