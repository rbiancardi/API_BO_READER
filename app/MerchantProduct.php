<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantProduct extends Model
{
    protected $table = "merchant_product";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'merchant_id', 'product_id',  'created_at', 'updated_at', 'deleted_at',
    ];
}
