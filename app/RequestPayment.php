<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestPayment extends Model
{
    protected $fillable = ['amount','toClient','forCaseId','lawyerId','status'];
    protected $table = 'RequestPayment';
}
