<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title'             => 'E-mart online shopping',
            'meta_description'  => 'E-mart online shopping',
            'meta_keywords'     => 'E-mart, Online shopping, E-commerce website',
            'logo'              => 'frontend/img/core-img/emart.png',
            'favicon'           => '',
            'address'           => 'Dhaka, Bangladesh',
            'email'             => 'info@emart.com',
            'phone'             => '01855555076',
            'fax'               => '002 4567 4567',
            'footer'            => 'Shihab Uddin',
            'facebook_url'      => '',
            'twitter_url'       => '',
            'linkedin_url'      => '',
            'painterest_url'     => '',
        ]);
    }
}
