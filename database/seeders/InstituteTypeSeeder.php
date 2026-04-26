<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstituteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institute_types = array(
            array('id' => '1','name' => 'Union'),
            array('id' => '2','name' => 'Pourashava'),
            array('id' => '3','name' => 'City Corporation'),
        );
        DB::table('institute_types')->insert($institute_types);
    }
}
