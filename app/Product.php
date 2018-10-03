<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name','alias_keyword','price','unit_product','intro','color','size','quantity','description','picture','status','user_id','cate_id'];

    public $timestamps = false;

    public function cate(){
    	return $this->belongTo('App\Cate');
    }

    public function user(){
    	return $this->belongTo('App\User');
    }

    public function pimages(){
    	return $this->hasMany('App\ProductImage');
    }
}
