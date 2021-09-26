<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'images' =>'product-01.jpg-236.jpg',
        'product_id' => Product::inRandomOrder()->first(),
        'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
