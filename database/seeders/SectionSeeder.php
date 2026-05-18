<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department\Department;
use App\Models\Department\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin       = Department::where('name', 'Administration')->first();
        $revenue     = Department::where('name', 'Revenue')->first();
        $land        = Department::where('name', 'Land Administration')->first();
        $general     = Department::where('name', 'General')->first();
        $disaster    = Department::where('name', 'Disaster Management')->first();
        $certificate = Department::where('name', 'Certificate')->first();
        $legal       = Department::where('name', 'Legal')->first();
        $la          = Department::where('name', 'LA (Land Acquisition)')->first();
        $ict         = Department::where('name', 'ICT')->first();

        $designations = [

            // Administration
            [ 'department_id' => $admin->id, 'name' => 'Deputy Commissioner', 'bn_name' => 'জেলা প্রশাসক' ],
            [ 'department_id' => $admin->id, 'name' => 'Additional Deputy Commissioner', 'bn_name' => 'অতিরিক্ত জেলা প্রশাসক' ],
            [ 'department_id' => $admin->id, 'name' => 'Assistant Commissioner', 'bn_name' => 'সহকারী কমিশনার' ],

            // Revenue
            [ 'department_id' => $revenue->id, 'name' => 'ADC Revenue', 'bn_name' => 'এডিসি রাজস্ব' ],
            [ 'department_id' => $revenue->id, 'name' => 'AC Land', 'bn_name' => 'সহকারী কমিশনার (ভূমি)' ],
            [ 'department_id' => $revenue->id, 'name' => 'Kanungo', 'bn_name' => 'কানুনগো' ],
            [ 'department_id' => $revenue->id, 'name' => 'Surveyor', 'bn_name' => 'সার্ভেয়ার' ],

            // Land
            [ 'department_id' => $land->id, 'name' => 'Tahsildar', 'bn_name' => 'তহসিলদার' ],
            [ 'department_id' => $land->id, 'name' => 'Assistant AC Land', 'bn_name' => 'সহকারী ভূমি কর্মকর্তা' ],


            // General
            [ 'department_id' => $general->id, 'name' => 'Office Assistant', 'bn_name' => 'অফিস সহকারী' ],
            [ 'department_id' => $general->id, 'name' => 'Data Entry Operator', 'bn_name' => 'ডাটা এন্ট্রি অপারেটর' ],

            // Disaster
            [ 'department_id' => $disaster->id, 'name' => 'Project Implementation Officer', 'bn_name' => 'প্রকল্প বাস্তবায়ন কর্মকর্তা' ],
            [ 'department_id' => $disaster->id, 'name' => 'Field Officer', 'bn_name' => 'ফিল্ড অফিসার' ],

            // Certificate
            [ 'department_id' => $certificate->id, 'name' => 'Certificate Officer', 'bn_name' => 'সার্টিফিকেট অফিসার' ],

            // Legal
            [ 'department_id' => $legal->id, 'name' => 'Legal Advisor', 'bn_name' => 'আইন উপদেষ্টা' ],

            // LA
            [ 'department_id' => $la->id, 'name' => 'Land Acquisition Officer', 'bn_name' => 'ভূমি অধিগ্রহণ কর্মকর্তা' ],

            // ICT
            [ 'department_id' => $ict->id, 'name' => 'ICT Officer', 'bn_name' => 'আইসিটি অফিসার' ],
            [ 'department_id' => $ict->id, 'name' => 'Programmer', 'bn_name' => 'প্রোগ্রামার' ],
            [ 'department_id' => $ict->id, 'name' => 'Data Analyst', 'bn_name' => 'ডাটা বিশ্লেষক' ],
        ];

        foreach ($designations as $desig) {
            Section::create($desig);
        }
    }
}