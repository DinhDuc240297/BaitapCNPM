<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billdetail extends Model
{
    protected $table = 'bill_details';

    protected $fillable = ['order_id','total','payment','unit_price','quantity','note'];

    public $timestamps = false;

}
