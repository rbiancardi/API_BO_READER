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
        'id', 'sector_name', 'sector_description','enable', 'created_at', 'user_creator', 'updated_at', 'updated_by',  'deleted_at',
    ];

    

    public function branchOffices()
    {
        return $this->belongsToMany('App\BranchOffice', 'branchOffices_branchSectors', 'branchSectors_id', 'branchOffices_Id');
    }

    public function readers()
    {
        return $this->hasMany('App\Reader', 'branchSector_id');
    }

    public function products()
    {                                                //Tabla Pivot             Foreign Key      Local Key
        return $this->belongsToMany('App\Product', 'branch_sector_product', 'branchSector_id', 'product_id');
    }

    
}
