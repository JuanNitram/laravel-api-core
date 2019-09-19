<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTypesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins_types')->insert([
                   [
                       'name'              => 'superadmin',
                       'created_at'        => '2019-12-04 18:02:57',
                       'updated_at'        => '2019-12-04 18:02:57',
                   ],
                   [
                       'name'              => 'admin',
                       'created_at'        => '2019-12-04 18:02:57',
                       'updated_at'        => '2019-12-04 18:02:57',
                   ]
               ]);
    }
}
