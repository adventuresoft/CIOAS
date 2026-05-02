<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstituteCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institute_categories = array(
            array('id' => '1','name' => 'Working'),
            array('id' => '2','name' => 'Monitoring'),
        );
        DB::table('institute_categories')->insert($institute_categories);
    }
}
