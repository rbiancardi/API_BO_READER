<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    
    protected $table = "readers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'reader_name','merchant_id', 'branch_id','branchSector_id', 'reader_ip',
         'enable', 'created_at', 'updated_at', 'deleted_at',
    ];


    public function merchant()
    {
        return $this->belongsTo('App\Merchant', 'id');
    }

    
    public function branchSector()
    {
        return $this->belongsTo('App\BranchSector', 'id', 'branchSector_id');
    }

    public function branchOffice()
    {
        return $this->belongsTo('App\BranchOffice', 'id');
    }

}
