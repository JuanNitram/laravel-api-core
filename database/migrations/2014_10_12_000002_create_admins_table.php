<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('admins'))
            Schema::create('admins', function (Blueprint $table) {
                $table->increments('id');

                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');

                $table->integer('types_id')->unsigned()->default(2);
                $table->foreign('types_id')->references('id')->on('admins_types');

                $table->boolean('active')->default(0);
                $table->float('pos')->default(0);

                $table->rememberToken();
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
        // Schema::dropIfExists('admins');
    }
}
