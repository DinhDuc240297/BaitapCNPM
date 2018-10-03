<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';

    protected $fillable = ['id','province_name'];

    public $timestamps = false;
}
