<?php
use App\Jobs\address;
use App\Events\CreateOrder;
// use App\Notifications\productAddToCart;
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//search by productname using Algolia
Route::post('/search','productController@search');
//search by brands 
Route::post('/search/{brand}','BrandController@search');

//userCRUD and resources
Route::post('/login','usercontroller@login');
Route::post('/register','usercontroller@register');

//product CRUD and resources
Route::get('/products','productController@index');
Route::middleware('auth:api')->post('/products','productController@create')->middleware('checkRole')->middleware('checkBrand');
Route::get('/products/lang/{lang}','productController@index')->middleware('checlocale');
Route::get('/products/{id}','productController@show');
Route::middleware('auth:api')->delete('/products/{id}','productController@destroy')->middleware('checkId');
Route::middleware('auth:api')->put('/products/{id}','productController@update');  

//BrandCRUD and resources
Route::middleware('auth:api')->post('/brands','BrandController@create')->middleware('checkRole');
Route::get('/brands','BrandController@index');
Route::get('/brands/{id}','BrandController@show');
Route::middleware('auth:api')->put('/brands/{id}','BrandController@update')->middleware('checkIdBrand');
Route::middleware('auth:api')->delete('brands/{id}','BrandController@destroy')->middleware('checkIdBrand');
// Route::get('/buynow/{id}','CartController@buyNow')->middleware('checkIdCart');

//cartCRUD 
Route::middleware('auth:api')->get('/carts','CartController@show');
Route::middleware('auth:api')->delete('/carts','CartController@clearCart')->middleware('checkIdCart');
//cartItemCRUD
Route::middleware('auth:api')->post('/cartitems','CartItemController@create');
Route::middleware('auth:api')->put('/cartitems/{id}','CartItemController@update')->middleware('checkIdCartItem');
Route::middleware('auth:api')->delete('/cartitems/{id}','CartItemController@destroy')->middleware('checkIdCartItem');

//pockets
Route::middleware('auth:api')->put('/pocket','pocketController@update');
Route::middleware('auth:api')->post('/payment','pocketController@payment');
//resources//
Route::get('/profile/{id}','ApiResourcesController@profile');
Route::get('/category','ApiResourcesController@categories');
Route::get('/brands','ApiResourcesController@brands');
Route::get('/products','ApiResourcesController@products');

Route::get('/',function(){
// event(new create());
// dispatch(new address());
event(new CreateOrder());
});