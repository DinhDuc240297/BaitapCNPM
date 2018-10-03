<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart1;
use Cart;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $request){
    	$productid = $request ->productid;

    	$productByid = Product::where('id', $productid)->first();
    	Cart::add([
    		'id' => $productid,
    		'name' => $productByid->name,
    		'price' => $productByid->price,
    		'qty' => $request->qty
    	]);

    	return redirect('fontend/shop');
    }

    public function cartShow(){
    	$cartProducts = Cart::Content();

    	return view('fontend.shop.cartshow',['cartProducts' => $cartProducts]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $products = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart1($oldCart);
        $cart-> add($products,$products->$id);

        $request->session()->put('cart',$cart);
        return redirect()->route('home.index');

    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view ('fontend.shop.cartshow',['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart1($oldCart);
        return view('fontend.shop.cartshow',['products' => $cart->items]);
    }
}
