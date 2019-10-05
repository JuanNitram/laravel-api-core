<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTypesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_types')->insert([
                   [
                       'name'              => 'User',
                       'created_at'        => '2019-12-04 18:02:57',
                       'updated_at'        => '2019-12-04 18:02:57',
                   ],
               ]);
    }
}
