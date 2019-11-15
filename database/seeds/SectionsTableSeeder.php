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
                    'icon'              => 'mdi-account-multiple',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'products',
                    'icon'              => 'mdi-cart',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'sliders',
                    'icon'              => 'mdi-image',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'sections',
                    'icon'              => 'mdi-application',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'categories',
                    'icon'              => 'mdi-shape',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
                [
                    'name'              => 'subcategories',
                    'icon'              => 'mdi-shape-outline',
                    'active'            => 1,
                    'created_at'        => '2019-12-04 18:02:57',
                    'updated_at'        => '2019-12-04 18:02:57',
                ],
               ]);
    }
}
