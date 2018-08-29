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
        'branch_id', 'branchSector_id', 'enable', 'user_creator', 'updated_by', 'created_at', 'updated_at'
    ];

    public function merchants()
    {
        return $this->belongsToMany('App\Merchant')
            ->withTimestamps();
    }

    public function currencies()
    {
        return $this->belongsToMany('App\Currency', 'currency_product')//, 'id', 'currency_id')
            ->withTimestamps();
    }

    public function branchSectors()
    {                                                   //Tabla Pivot             Foreign Key     Local Key
        return $this->belongsToMany('App\BranchSector', 'branch_sector_product', 'product_id', 'branchSector_id')
            ->withTimestamps();
    }

    public function branchOffices()
    {
        return $this->belongsToMany('App\BranchOffice', 'branchOffice_product', 'product_id', 'branchOffice_id')
            ->withTimestamps();
    }

}
