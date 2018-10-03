<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = ['image','description','product_id'];

    public $timestamps = false;


    public function product(){
    	return $this->belongTo('App\Product');
    }
}
