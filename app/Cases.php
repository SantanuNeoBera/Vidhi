<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $fillable = ['userId','caseTitle','caseCategory','caseDueDate','caseDescription','isOnlyAdvisable','attachmentPrivacy','postAsAnonymous','displayId','caseStatus'];
    protected $table = 'Cases';
}
