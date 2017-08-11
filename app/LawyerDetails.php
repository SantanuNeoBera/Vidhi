<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LawyerDetails extends Model
{
    protected $fillable = ['id','firstName','middleName','lastName','country','Gender','mobileNo','state','city','experience','designation','education','photo','professionalSummary','stateBarCouncil','barCouncilRegNo','uploadBarCouncil','nameOfBarAssociation','courtName'];
    protected $table = 'LawyerDetails';
    public $incrementing=false;
    protected $primarykey = 'id';
}
