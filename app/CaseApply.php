<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseApply extends Model
{
    protected $fillable = ['caseId','userId','lawyerId','appliedDate','status','isFixedRate','isHourlyRate','totalAmount','comment','clientCanContact','wantAdvancePayment','advancePercentage','amountPerHour','estimatedHour'];
    protected $table = 'CaseApply';
}
