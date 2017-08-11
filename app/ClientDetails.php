<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDetails extends Model
{
    protected $fillable = ['firstName','middleName','lastName','country','Gender','mobileNo','id','address','state','city','age','occupation','educationLavel'];
    protected $table = 'clientDetails';
    public $incrementing=false;
    protected $primarykey = 'id';
}
