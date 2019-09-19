<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(!Schema::hasTable('categories'))
            Schema::create('categories', function (Blueprint $table) {
                $table->increments('id');

                $table->string('name');

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
