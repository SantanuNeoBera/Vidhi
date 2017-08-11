<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaInfo extends Model
{
    protected $fillable = ['meta_category','meta_key','meta_value','isActive'];
    protected $table = 'MetaInfo';
    public $incrementing=false;
    protected $primarykey = null;
}
