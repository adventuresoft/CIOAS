<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax_years = [
            ['name' => '2021-2022', 'bn_name' => '২০২১-২০২২', 'status' => true ],
            ['name' => '2022-2023', 'bn_name' => '২০২২-২০২৩', 'status' => true ],
        ];
        DB::table('tax_years')->insert($tax_years);
    }
}
