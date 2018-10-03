<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionPrice extends Model
{
    protected $table = 'promotion_price';

    protected $fillable = ['product_id','total_sales','code_sales','date_start','date_finish','note'];

    public $timestamps = false;
}
