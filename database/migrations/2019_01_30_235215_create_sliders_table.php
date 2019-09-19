<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(!Schema::hasTable('sliders'))
            Schema::create('sliders', function (Blueprint $table) {
                $table->increments('id');

                $table->text('title')->nullable();
                $table->text('subtitle')->nullable();
                $table->text('url')->nullable();

                $table->float('pos')->default(0);
                $table->boolean('active')->default(1);

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
