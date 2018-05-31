<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxType extends Model
{
    protected $table = "trxTypes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type_name', 'type_description',
        'enable', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function transactions()
    {
        return $this->hasMany('App\Transaction', 'transaction_type', 'type_name');
    }

}
