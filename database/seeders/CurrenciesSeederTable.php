<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert(
            [
                [
                    'name' => 'USA Dollar',
                    'symbol' => '$',
                    'exchange_rate' => 1,
                    'code' => 'USD'
                ],
                [
                    'name' => 'Bangladeshi Taka',
                    'symbol' => 'Tk.',
                    'exchange_rate' => 86,
                    'code' => 'BAN'
                ]
            ]
            );
    }
}
