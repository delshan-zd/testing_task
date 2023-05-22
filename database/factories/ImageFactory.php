<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use App\Models\post;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    protected $model=Image::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $imageable=$this->imageable();


          return [
              'image' => $this->faker->imageUrl(800, 280),
          'imageable_id'=>$imageable::factory(),
           'imageable_type' =>$imageable,
        ];
    }
    public function imageable(){

        return $this->faker->randomElement([
            Post::class,
            User::class

        ]);
    }


}
