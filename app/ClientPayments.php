<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPayments extends Model
{
	protected $fillable = ['amount', 'fromClientId', 'forCaseId', 'ToLawyerId', 'paymentStatus'];
    protected $table = "ClientPayments";
}
