<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
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
        $title = $this->faker->name();
        return [
            'title' => $this->faker->name(),
            'slug' => Str::slug($title),
            'summary' => $this->faker->sentence(20),
            'description' => $this->faker->sentence(20,true),
            'image_icon' =>'219.jpg',
            // 'image' =>$this->faker->image('public/images/categories',400,300),
            'price' => $this->faker->numberBetween(1,50),
            'brand_name' => $this->faker->text(8,true),
            'product_code' => $this->faker->numberBetween(1,50),
            'discount_percent' => $this->faker->numberBetween(1,50),
            'category_id' => Category::inRandomOrder()->first(),
            'colour' => $this->faker->randomElement(['red', 'blue','grey','white']),
            'size' => $this->faker->randomElement(['L', 'M','S','XL']),
            // 'images' => [
            //     'images' => [
            //         'https://images.pexels.com/photos/3621234/pexels-photo-3621234.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
            //         'https://images.pexels.com/photos/3806986/pexels-photo-3806986.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
            //         'https://images.pexels.com/photos/4397919/pexels-photo-4397919.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
            //         ]
            // ],
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
