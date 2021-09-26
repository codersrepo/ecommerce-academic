<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

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
            'image' =>'357.jpg',
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
