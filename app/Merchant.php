<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $table = "merchants";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'merchant_id', 'merchant_name', 'secret_key','merchant_description',
        'customer_id', 'enable', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'secret_key'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function branchOffices()
    {
        return $this->hasMany('App\BranchOffice', 'merchant_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function readers()
    {
        return $this->hasMany('App\Reader', 'merchant_id');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer');
    }

}
