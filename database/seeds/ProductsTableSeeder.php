<?php

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 300; $i++){
            $category = Categories::all()->random(1)->first();
            $product = factory(Products::class)->create([
                'categories_id' => $category->id
            ]);
        }
    }
}
