<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            // 'title' => 'Shop Here',
            'status' => 'active',
            // 'summary' => 'find the best products here',
            'image' => 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Z2FybWVudHxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80',
        ]);
    }
}
