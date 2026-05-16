<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [ 'name' => 'Administration', 'bn_name' => 'প্রশাসন' ],
            [ 'name' => 'Revenue', 'bn_name' => 'রাজস্ব' ],
            [ 'name' => 'Land Administration', 'bn_name' => 'ভূমি প্রশাসন' ],
            [ 'name' => 'General', 'bn_name' => 'সাধারণ' ],
            [ 'name' => 'Nazir', 'bn_name' => 'নাজির' ],
            [ 'name' => 'Disaster Management', 'bn_name' => 'দুর্যোগ ব্যবস্থাপনা' ],
            [ 'name' => 'Certificate', 'bn_name' => 'সার্টিফিকেট' ],
            [ 'name' => 'Legal', 'bn_name' => 'আইন' ],
            [ 'name' => 'LA (Land Acquisition)', 'bn_name' => 'ভূমি অধিগ্রহণ' ],
            [ 'name' => 'ICT', 'bn_name' => 'আইসিটি' ],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}