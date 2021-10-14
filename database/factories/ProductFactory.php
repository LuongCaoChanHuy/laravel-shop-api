<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id'=>rand(1,5),
            'category_id'=>rand(1,5),
            'title'=>$this->faker->name(),
            'description'=>$this->faker->text($maxNbChars = 350),
            'price'=>$this->faker->numberBetween($min = 5, $max = 200),
            'ratings'=>rand(1,5),
            'reviews'=>rand(1,20),
            'store'=>$this->faker->numberBetween($min = 5, $max=40),
            'image'=> 'default.jpg'
        ];
    }
}
