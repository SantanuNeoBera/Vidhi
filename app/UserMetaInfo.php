<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMetaInfo extends Model
{
    protected $fillable = ['id','userType','meta_category','meta_key','meta_value'];
    protected $table = 'userMetaInfo';
    public $incrementing=false;
    protected $primarykey = null;
    public $timestamps = false;
}
