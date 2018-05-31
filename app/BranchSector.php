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
        'id', 'sector_name', 'sector_description', 'branch_id',
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
    {
        return $this->belongsToMany('App\Product');
    }

}
