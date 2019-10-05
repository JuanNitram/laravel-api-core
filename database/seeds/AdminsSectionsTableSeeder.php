<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsSectionsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins_sections')->insert([
                [
                    'admins_id'         => 1,
                    'sections_id'       => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'admins_id'         => 1,
                    'sections_id'       => 2,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'admins_id'         => 1,
                    'sections_id'       => 3,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'admins_id'         => 1,
                    'sections_id'       => 4,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'admins_id'         => 1,
                    'sections_id'       => 5,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'admins_id'         => 1,
                    'sections_id'       => 6,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
               ]);
    }
}
