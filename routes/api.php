<?php
 
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
//cartCRUD 
Route::middleware('auth:api')->get('/carts','CartController@index');
//cartItemCRUD
Route::middleware('auth:api')->post('/cartitems','CartItemController@create');
Route::middleware('auth:api')->put('/cartitems/{id}','CartItemController@update')->middleware('checkIdCartItem');
Route::middleware('auth:api')->delete('/cartitems/{id}','CartItemController@destroy')->middleware('checkIdCartItem');
//pockets
Route::middleware('auth:api')->put('/pocket','PocketController@update');
Route::middleware('auth:api')->post('/checkout','PocketController@checkout');
//resources//
Route::get('/profile/{id}','ApiResourcesController@profile');
Route::get('/category','ApiResourcesController@categories');
Route::get('/brands','ApiResourcesController@brands');
Route::get('/products','ApiResourcesController@products');
// Address
Route::middleware('auth:api')->post('/address','AddressController@create');