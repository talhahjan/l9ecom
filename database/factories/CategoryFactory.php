<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title=$this->faker->unique()->sentence(2);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description'=>$this->faker->paragraph,
            'discount' => rand(0,1),
            'section_id'=>rand(1,2),
        ];
    }
}
