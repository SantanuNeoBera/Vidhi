<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationDetails extends Model
{
    protected $fillable = ['id','orgName','orgType','country','mobileNo','isBlocked','address','state','city','age','areaBusiness'];
    protected $table = 'organizationDetails';
    public $incrementing=false;
}
