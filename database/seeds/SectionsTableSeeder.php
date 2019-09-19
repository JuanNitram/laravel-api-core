<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
                [
                    'name'              => 'admins',
                    'icon'              => 'supervised_user_circle',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'products',
                    'icon'              => 'question_answer',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'sliders',
                    'icon'              => 'collections',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'sections',
                    'icon'              => 'question_answer',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'categories',
                    'icon'              => 'question_answer',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'subcategories',
                    'icon'              => 'question_answer',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
               ]);
    }
}
