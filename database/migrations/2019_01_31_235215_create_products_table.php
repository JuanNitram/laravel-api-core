<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(!Schema::hasTable('products'))
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');

                $table->string('name');
                $table->text('description')->nullable();
                $table->text('description_quill')->nullable();

                $table->text('currency')->nullable();
                $table->float('price')->default(0);

                $table->text('sale_currency')->nullable();
                $table->float('sale_price')->default(0);

                $table->boolean('highlighted')->default(0);
                $table->boolean('active')->default(1);
                $table->float('pos')->default(0);

                $table->integer('categories_id')->unsigned()->nullable();
                $table->foreign('categories_id')->references('id')->on('categories');

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
