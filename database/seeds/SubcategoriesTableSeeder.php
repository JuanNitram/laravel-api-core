<?php

use App\Models\Categories;
use App\Models\Subcategories;
use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Categories::all() as $category){
            for($i = 0; $i < rand(1, 5); $i++){
                factory(Subcategories::class)->create([
                   'categories_id' => $category->id,
                ]);
            }
        }
    }
}
