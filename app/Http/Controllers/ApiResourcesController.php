<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Paginate;
use App\Http\Resources\CategoryResource;
use App\Category;
use App\Http\Resources\BrandResource;
use App\Brand;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Http\Resources\UserResource;
use App\User;

class ApiResourcesController extends Controller
{
    public function categories(){
        return CategoryResource::collection(Category::paginate(15));
    }
    public function brands(){
        return BrandResource::collection(Brand::paginate(15));
    }
    public function products(){
        return ProductResource::collection(Product::paginate(5));
    }
    public function profile($id){
        return new UserResource(User::find($id));
    }
}
