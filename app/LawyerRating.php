<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LawyerRating extends Model
{
    protected $fillable = ['userId','lawyerId','review','rating','userName'];
    protected $table = 'lawyerReviews';
}
