<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = array(
            'name' => 'Admin',
            'email' => 'admin@ecom.com',
            'password' => Hash::make("admin123"),
            'status' => 'active',
            'phone_number' => '9861087087'
        );
        if(Admin::where('email', $Admin['email'])->count() <= 0){
            Admin::insert($Admin);
        }
    }
}
