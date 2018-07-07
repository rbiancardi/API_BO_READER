<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOfficeProduct extends Model
{
    protected $table = "branchOffice_product";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'branchOffice_id', 'product_id',  'created_at', 'updated_at', 'deleted_at',
    ];
}
