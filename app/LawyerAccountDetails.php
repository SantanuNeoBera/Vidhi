<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LawyerAccountDetails extends Model
{
    protected $fillable = ['id','bankName','branchName','accountHolderName','IFSCCode','accountNumber'];
    protected $table = 'LawyerAccountDetails';
    public $incrementing=false;
    protected $primarykey = null;
    public $timestamps = false;
}
