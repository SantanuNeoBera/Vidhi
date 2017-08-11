<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    protected $fillable = ['id','userType','isBlocked'];
    public $timestamps = false;
    public $incrementing = false;
    protected $primarykey = null;
    protected $table = 'UserMaster';
}
