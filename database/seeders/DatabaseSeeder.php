<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Thumbnail;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $this->call([
            AdminUserProfile::class,
            BrandSeeder::class,
            CategorySectionSeeder::class,
        ]);

     // The Perfect way to create fake data 
              Category::factory()->count(14
              )->
              has(Product::factory()->count(rand(50,120
              ))->has(
                Thumbnail::factory()
                        ->count(rand(1,2))
                        ->state(function (array $attributes, Product $product) {
                            return ['product_id' => $product->id];
                        })
              ))->create();



    }
}
