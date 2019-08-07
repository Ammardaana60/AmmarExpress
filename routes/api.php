<?php
//search by tagging 
Route::post('/tags','ProductController@tags');
//search by productname using Algolia
Route::post('/search','ProductController@search');
//search by brands 
Route::post('/search/{brand}','BrandController@search');

//userCRUD and resources
Route::post('/login','UserController@login');
Route::post('/register','UserController@register');

//product CRUD and resources
Route::get('/productsf','ProductController@index');
Route::middleware('auth:api')->post('/products','ProductController@create')->middleware('checkRole')->middleware('checkBrand');
Route::get('/products/{id}','ProductController@show');
Route::middleware('auth:api')->delete('/products/{id}','ProductController@destroy')->middleware('checkId');
Route::middleware('auth:api')->put('/products/{id}','ProductController@update');  
Route::post('/excelproducts','ProductController@readExcelFile');
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
//->middleware('checkUserOrGuest')

//pockets
Route::middleware('auth:api')->put('/pocket','PocketController@update');
Route::middleware('auth:api')->post('/payment','PocketController@payment');
//resources//
Route::get('/profile/{id}','ApiResourcesController@profile');
Route::get('/category','ApiResourcesController@categories');
Route::get('/brands','ApiResourcesController@brands');
Route::get('/products','ApiResourcesController@products');

// Address
Route::middleware('auth:api')->post('/address','AddressController@create');
Route::get('/tokens',function(){
//dd($tokens =Request()->header('Authorization'));
//$token=Request()->cookie($tokens);
//return $token;
});