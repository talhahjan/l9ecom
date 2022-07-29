<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Thumbnail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thumbnail>
 */
class ThumbnailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   
private $images=null;


public function getImages(){
if($this->images)
return $this->images;


$images=file_get_contents('https://fakestoreapi.com/products');
$this->images=json_decode($images,true);
return $this->images;
    
}

    public function definition()
    {
    $this->getImages();

        return [
       'path'=> $this->images[rand(0,19)]['image'],
        ];
    }
}
