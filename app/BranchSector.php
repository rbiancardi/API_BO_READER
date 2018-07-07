<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchSector extends Model
{
    protected $table = "branchSectors";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'sector_name', 'branchSector_id', 'branch_id',
        'enable', 'created_at', 'updated_at', 'deleted_at',
    ];

    

    public function branchOffices()
    {
        return $this->belongsTo('App\BranchOffice', 'id');
    }

    public function readers()
    {
        return $this->hasMany('App\Reader', 'id');
    }

    public function products()
    {                                                //Tabla Pivot             Foreign Key      Local Key
        return $this->belongsToMany('App\Product', 'branch_sector_product', 'branchSector_id', 'product_id');
    }

}
