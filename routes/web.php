<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('fontend/shop/add-to-cart/{id}',[
	'uses' => 'CartController@getAddToCart',
	'as' => 'product.addcart'
]);
 // Route::post('fontend/shop/cart-add','CartController@addToCart');
 // Route::get('fontend/shop/cart-show',[
 // 	'uses' => 'CartController@cartShow',
 // 	'as' => 'product.showcart',
 // ]);
Route::get('fontend/shop/show-cart',[
	'uses' => 'CartController@getCart',
	'as' => 'product.showcart'
]);

Route::get('testtemplate',function(){
	return view('fontend.shop.home-kekule');
});



Auth::routes();

Route::get('/dashboard', 'DashboardController@index');  
Route::get('/profile', 'ProfileController@index');

Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
Route::resource('user-management', 'UserManagementController');

Route::resource('customer-management', 'CustomerManagementController');
Route::post('customer-management/search', 'CustomerManagementController@search')->name('customer-management.search');

Route::resource('system-management/product-type', 'ProductTypeController');
Route::post('system-management/product-type/search', 'ProductTypeController@search')->name('product-type.search');

Route::resource('system-management/product', 'ProductController');
Route::post('system-management/product/search', 'ProductController@search')->name('product.search');

Route::resource('system-management/promotion', 'PromotionController');
Route::post('system-management/promotion/search', 'PromotionController@search')->name('promotion.search');

Route::resource('order-bill', 'OrderBillController');
Route::post('order-bill/search', 'OrderBillController@search')->name('order-bill.search');

Route::resource('ton-kho', 'TonkhoController');
Route::post('ton-kho/search', 'TonkhoController@search')->name('ton-kho.search');


Route::get('fontend/shop',[
	'uses' => 'HomeController@getIndex',
	'as' => 'home.index'
]);


Route::group(['prefix' => 'fontend/shop/user'],function(){
	Route::group(['middleware' => 'guest'],function(){
		Route::get('/signup',[
		'uses' => 'CustomerManagementController@getSignup',
		'as' => 'user.signup'
		]);
		Route::post('/signup',[
			'uses' => 'CustomerManagementController@postSignup',
			'as' => 'user.signup'
		]);
		Route::get('/signin',[
			'uses' => 'CustomerManagementController@getSignin',
			'as' => 'user.signin'
		]);
		Route::post('/signin',[
			'uses' => 'CustomerManagementController@postSignin',
			'as' => 'user.signin'
		]);
	});
	Route::group(['middleware' => 'auth'], function(){
		Route::get('/profile',[
		'uses' => 'CustomerManagementController@getProfile',
		'as' => 'user.profile'
		]);
		Route::get('/logout',[
			'uses' => 'CustomerManagementController@getLogout',
			'as' => 'user.logout'
		]);
	});
});

