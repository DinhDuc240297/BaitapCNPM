<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = ['order_name','customer_id','product_id','date_added','message','status'];

    public $timestamps = false;
}
