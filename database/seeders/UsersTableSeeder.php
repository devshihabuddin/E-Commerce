<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //customer
        DB::table('users')->insert([  
            
            [
                'full_name' => 'Mr. Customer',
                'username'  => 'Customer',
                'email'     => 'customer@gmail.com',
                'password'  => Hash::make('123'),
                'status'    => 'active',
            ],
        ]);

        //admin
        DB::table('admins')->insert([  
           
            [
                'full_name' => 'Mr. Admin',
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('123'),
                'status'    => 'active',
            ],
        ]);

        //sellers
        DB::table('sellers')->insert([  
           
            [
                'full_name'     => 'Mr. Seller',
                'username'      => 'Mr. Seller',
                'email'         => 'seller@gmail.com',
                'address'       => 'Dahaka, Bangladesh',
                'phone'         => '01753454835',
                'photo'         =>'',
                'password'      => Hash::make('123'),
                'is_verified'   => 0,
                'status'        => 'active',
            ],
        ]);
    }
}
