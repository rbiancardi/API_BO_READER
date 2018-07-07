<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{

    protected $table = "branchOffices";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'branch_id', 'branch_name', 'merchant_id', 'branch_name',
        'branch_country', 'branch_location', 'enable', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function merchants()
    {
        return $this->belongsTo('App\Merchant', 'id');
    }

    public function readers()
    {
        return $this->hasMany('App\Reader', 'branch_id');
    }

    public function branchSectors()
    {
        return $this->hasMany('App\BranchSector', 'branch_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'branchOffice_product', 'branchOffice_id', 'product_id');
    }

}
