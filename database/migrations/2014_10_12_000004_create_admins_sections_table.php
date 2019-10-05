<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsSectionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(!Schema::hasTable('admins_sections'))
            Schema::create('admins_sections', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('admins_id')->unsigned();
                $table->foreign('admins_id')->references('id')->on('admins');

                $table->integer('sections_id')->unsigned();
                $table->foreign('sections_id')->references('id')->on('sections');

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
