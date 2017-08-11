<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
	protected $fillable = ['userId','userType','actionType','oldValue','newValue','caseId'];
    protected $table = 'ActionLog';
}
