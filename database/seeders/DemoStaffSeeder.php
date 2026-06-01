<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\People;
use App\Models\People\ProfessionalInfo;
use Illuminate\Support\Facades\Hash;

class DemoStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demoUsers = [
            [
                'name' => 'Md. Asaduzzaman DC Staff',
                'bn_name' => 'মোঃ আসাদুজ্জামান ডিসি স্টাফ',
                'email' => 'dc.demo@gmail.com',
                'department_id' => 1, // Administration
                'section_id' => 1,    // Deputy Commissioner
                'designation' => 'Deputy Commissioner',
                'mobile' => '01711223344',
            ],
            [
                'name' => 'Sultana Razia ADC Staff',
                'bn_name' => 'সুলতানা রাজিয়া এডিসি স্টাফ',
                'email' => 'adc.demo@gmail.com',
                'department_id' => 1, // Administration
                'section_id' => 2,    // Additional Deputy Commissioner
                'designation' => 'Additional Deputy Commissioner',
                'mobile' => '01711223345',
            ],
            [
                'name' => 'Md. Rafiqul Islam ADC Rev Staff',
                'bn_name' => 'মোঃ রফিকুল ইসলাম এডিসি রাজস্ব স্টাফ',
                'email' => 'adc.rev.demo@gmail.com',
                'department_id' => 2, // Revenue
                'section_id' => 4,    // ADC Revenue
                'designation' => 'ADC Revenue',
                'mobile' => '01711223346',
            ],
            [
                'name' => 'Nusrat Jahan AC Land Staff',
                'bn_name' => 'নুসরাত জাহান এসি ল্যান্ড স্টাফ',
                'email' => 'ac.land.demo@gmail.com',
                'department_id' => 2, // Revenue
                'section_id' => 5,    // AC Land
                'designation' => 'AC Land',
                'mobile' => '01711223347',
            ],
        ];

        foreach ($demoUsers as $data) {
            // Clean up existing to ensure clean seed run
            $existingUser = User::where('email', $data['email'])->first();
            if ($existingUser) {
                ProfessionalInfo::where('user_id', $existingUser->id)->delete();
                People::where('user_id', $existingUser->id)->delete();
                $existingUser->delete();
            }

            // Create User
            $user = new User();
            $user->role_id = 5; // Staff/User
            $user->institute_id = 3; // Matching requested institute_id = 3
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->mobile = $data['mobile'];
            $user->password = Hash::make('12345678');
            $user->department_id = $data['department_id'];
            $user->section_id = $data['section_id'];
            $user->status = true;
            $user->created_by = 1;
            $user->save();

            // Create People
            $people = new People();
            $people->user_id = $user->id;
            $people->bn_name = $data['bn_name'];
            $people->date_of_birth = '1988-06-15';
            $people->birth_place = 1;
            $people->district_id = 1;
            $people->country_id = 1;
            $people->gender = 1;
            $people->religion_id = 1;
            $people->blood_group = 1;
            $people->is_staff = 1;
            $people->save();

            // Generate staff_id
            $datePart = '880615';
            $districtPart = '01';
            $serialPart = str_pad($user->id, 4, '0', STR_PAD_LEFT);
            $people->staff_id = 'SID-' . $districtPart . '-' . $datePart . '-' . $serialPart;
            $people->save();

            // Create Professional Info
            $prof = new ProfessionalInfo();
            $prof->user_id = $user->id;
            $prof->profession_subcategory_id = 1; // Default subcategory
            $prof->recruitment_notice_no = 'RN-' . rand(100, 999);
            $prof->appointment_letter_no = 'AL-' . rand(100, 999);
            $prof->designation_joining = $data['designation'];
            $prof->date_of_joining = '2015-01-01';
            $prof->department = $data['department_id'];
            $prof->current_designation = $data['section_id'];
            $prof->date_current_designation = '2020-01-01';
            $prof->current_workplace = 'DC Office, Gopalganj';
            $prof->date_joining_current_workplace = '2020-01-01';
            $prof->save();
        }
    }
}
