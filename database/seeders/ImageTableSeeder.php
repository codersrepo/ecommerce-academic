<?php

namespace Database\Seeders;

use App\Models\ProductImages;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       ProductImages::factory()->count(30)->create();
    }
}
