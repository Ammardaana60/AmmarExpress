<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status')->default(1);///either 1 or 0
            $table->float('discount')->default(0);
            $table->string('product_name');
            $table->longText('product_description');
            $table->float('product_price')->unsigned();
            $table->integer('product_quantity')->unsigned();
            $table->string('ARproduct_name');
            $table->longText('ARproduct_description');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('properities');
            $table->string('tag');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            // $table->SoftDeletes();
            $table->timestamps();
           
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
