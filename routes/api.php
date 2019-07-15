<?php

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Category;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Http\Resources\BrandResource;
use App\Brand;
use App\Http\Resources\UserResource;
use App\User;
use App\Http\Resources\CartResource;
use App\Cart;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//search
Route::post('/search','productController@search');
//userCRUD and resources
Route::post('/login','usercontroller@login');
Route::post('/register','usercontroller@register');
Route::get('/profile/{id}',function($id){
    return new UserResource(User::find($id));
  });
//product CRUD and resources
Route::middleware('auth:api')->post('/product','productController@create');
Route::middleware('auth:api')->get('/product','productController@index');
Route::middleware('auth:api')->get('/product/{id}','productController@show');
Route::middleware('auth:api')->delete('/product/{id}','productController@destroy')->middleware('checkId');
Route::middleware('auth:api')->put('/product/{id}','productController@update')->middleware('checkId');
Route::get('/products',function(){
    return ProductResource::collection(Product::all());
});        

//BrandCRUD and resources
Route::middleware('auth:api')->post('/brand','BrandController@create');
Route::middleware('auth:api')->get('/brand','BrandController@index');
Route::middleware('auth:api')->get('/brand/{id}','BrandController@show');
Route::middleware('auth:api')->put('/brand/{id}','BrandController@update')->middleware('checkIdBrand');
Route::middleware('auth:api')->delete('brand/{id}','BrandController@destroy')->middleware('checkIdBrand');

//cartCRUD 
Route::middleware('auth:api')->post('/cart','CartController@create');
// Route::middleware('auth:api')->get('/cart/{id}','CartController@show');
Route::middleware('auth:api')->get('/cart/{id}','CartController@show');
Route::middleware('auth:api')->delete('/cart','CartController@clearCart')->middleware('checkIdCart');
Route::middleware('auth:api')->delete('/cart/{id}','CartController@destroy')->middleware('checkIdCart');
Route::middleware('auth:api')->put('/cart/{id}','CartController@update')->middleware('checkIdCart');
Route::get('/cart/buynow','CartController@buyNow');
//cartItemCRUD
Route::middleware('auth:api')->post('/cartitem','CartItemController@create');
Route::middleware('auth:api')->put('/cartitem','CartItemController@update');
Route::middleware('auth:api')->delete('/cartitem','CartItemController@destroy');

//resources//
Route::get('/category',function(){
    return categoryResource::collection(Category::all());
});
Route::get('/brands',function(){
    return BrandResource::collection(Brand::all());
});
Route::get('/brands/{id}',function($id){
return new BrandResource(Brand::find($id));
});


