<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    public function getIndex(){
    	$products = Product::all();
    	return view('fontend.shop.index',['products'=>$products]);
    }
}
