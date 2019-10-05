<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(!Schema::hasTable('products_subcategories'))
            Schema::create('products_subcategories', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('products_id')->unsigned()->nullable();
                $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');

                $table->integer('subcategories_id')->unsigned()->nullable();
                $table->foreign('subcategories_id')->references('id')->on('subcategories')->onDelete('cascade');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Schema::dropIfExists('media');
    }
}
