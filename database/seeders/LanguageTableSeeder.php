<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language_list = array(
            array(
                'language'  => 'English',
                'prefix'    => 'en'
            ),
            array(
                'language'  => 'नेपाली',
                'prefix'    => 'np'
            ),
        );
        foreach($language_list as $language){
            if(\App\Models\Language::where('prefix', $language['prefix'])->count() <= 0){
                \App\Models\Language::insert($language);
            }
        }
    }
}
