<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(!Schema::hasTable('sections'))
            Schema::create('sections', function (Blueprint $table) {
                $table->increments('id');

                $table->string('name');
                $table->string('icon')->nullable();

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
