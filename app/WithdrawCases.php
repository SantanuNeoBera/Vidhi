<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawCases extends Model
{
    protected $fillable = ['comment','userId','lawyerId'];
    protected $table = 'WithdrawCases';
}
