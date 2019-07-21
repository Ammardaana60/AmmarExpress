<?php


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//search
Route::post('/search','productController@search');

//userCRUD and resources
Route::post('/login','usercontroller@login');
Route::post('/register','usercontroller@register');

//product CRUD and resources
Route::middleware('auth:api')->get('/products','productController@index');
Route::middleware('auth:api')->post('/products','productController@create')->middleware('checkRole');
Route::middleware('auth:api')->get('/products/{lang}','productController@index')->middleware('checlocale');
Route::middleware('auth:api')->get('/products/{id}','productController@show');
Route::middleware('auth:api')->delete('/products/{id}','productController@destroy')->middleware('checkId');
Route::middleware('auth:api')->put('/products/{id}','productController@update')->middleware('checkId');  

//BrandCRUD and resources
Route::middleware('auth:api')->post('/brands','BrandController@create')->middleware('checkRole');
Route::middleware('auth:api')->get('/brands','BrandController@index');
Route::middleware('auth:api')->get('/brands/{id}','BrandController@show');
Route::middleware('auth:api')->put('/brands/{id}','BrandController@update')->middleware('checkIdBrand');
Route::middleware('auth:api')->delete('brands/{id}','BrandController@destroy')->middleware('checkIdBrand');
Route::middleware('auth:api')->get('/buynow/{id}','CartController@buyNow')->middleware('checkIdCart');

//cartCRUD 
Route::middleware('auth:api')->get('/carts','CartController@show');
Route::middleware('auth:api')->delete('/carts','CartController@clearCart')->middleware('checkIdCart');
//cartItemCRUD
Route::middleware('auth:api')->post('/cartitems','CartItemController@create');
Route::middleware('auth:api')->put('/cartitems/{id}','CartItemController@update')->middleware('checkIdCartItem');
Route::middleware('auth:api')->delete('/cartitems/{id}','CartItemController@destroy')->middleware('checkIdCartItem');

//pockets
Route::middleware('auth:api')->put('/pocket','pocketController@update');
Route::middleware('auth:api')->post('/payment','pocketController@payment')->middleware('checkIdPocket');
//resources//
Route::get('/profile/{id}','ApiResourcesController@profile');
Route::get('/category','ApiResourcesController@categories');
Route::get('/brands','ApiResourcesController@brands');
Route::get('/products','ApiResourcesController@products');


// /testing
Route::get('/pockets',function(){
return App\pocket::all();
});


