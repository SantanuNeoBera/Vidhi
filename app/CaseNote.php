<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseNote extends Model
{
    protected $fillable=['userId','caseId','notes'];
    protected $table = "CaseNotes";
}
