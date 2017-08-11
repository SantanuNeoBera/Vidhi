<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPaymentsAggrement extends Model
{
    protected $fillable = ['amount', 'clientId', 'forCaseId'];
    protected $table = "ClientPaymentsAggrement";
}
