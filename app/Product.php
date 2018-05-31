<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'barcode', 'desciption', 'price', 'currency_id', 'merchant_id',
        'branch_id', 'branch_sector_id', 'enable', 'created_at', 'updated_at', 'deleted_at',
    ];

    

    public function merchants()
    {
        return $this->belongsToMany('App\Merchant');
    }

    public function branchSectors()
    {
        return $this->belongsToMany('App\BranchSector');
    }

    public function branchOffices()
    {
        return $this->belongsToMany('App\BranchOffice');
    }

}
