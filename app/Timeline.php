<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = ['Action','lawyerId','caseId','RefId'];
    protected $table = 'Timeline';
}
