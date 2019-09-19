<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(!Schema::hasTable('subcategories'))
            Schema::create('subcategories', function (Blueprint $table) {
                $table->increments('id');

                $table->string('name');

                $table->integer('categories_id')->unsigned();
                $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');

                $table->boolean('active')->default(1);
                $table->float('pos')->default(0);

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
