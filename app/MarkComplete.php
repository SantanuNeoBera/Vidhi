<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkComplete extends Model
{
    protected $fillable = ['comment','caseId','lawyerId'];
    protected $table = 'MarkComplete';
}
