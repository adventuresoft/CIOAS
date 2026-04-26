<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CityCorporationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city_corporations = [
            ['id' => '1',   'district_id' => '65', 'name' => 'Dhaka North', 'bn_name' => 'ঢাকা উত্তর', 'slug' => Str::slug('Dhaka North', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '2',   'district_id' => '65', 'name' => 'Dhaka South', 'bn_name' => 'ঢাকা দক্ষিণ', 'slug' => Str::slug('Dhaka South', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '3',   'district_id' => '8', 'name' => 'Chattogram', 'bn_name' => 'চট্টগ্রাম', 'slug' => Str::slug('Chattogram', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '4',   'district_id' => '36', 'name' => 'Sylhet', 'bn_name' => 'সিলেট', 'slug' => Str::slug('Sylhet', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '5',   'district_id' => '69', 'name' => 'Barishal', 'bn_name' => 'বরিশাল', 'slug' => Str::slug('Barishal', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '6',   'district_id' => '27', 'name' => 'Khulna', 'bn_name' => 'খুলনা', 'slug' => Str::slug('Khulna', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '7',   'district_id' => '67', 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'slug' => Str::slug('Rajshahi', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '8',   'district_id' => '72', 'name' => 'Gazipur', 'bn_name' => 'গাজীপুর', 'slug' => Str::slug('Gazipur', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '9',   'district_id' => '43', 'name' => 'Narayanganj', 'bn_name' => 'নারায়ণগঞ্জ', 'slug' => Str::slug('Narayanganj', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '10',  'district_id' => '59', 'name' => 'Rangpur ', 'bn_name' => 'রংপুর', 'slug' => Str::slug('Rangpur', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '11',  'district_id' => '1', 'name' => 'Cumilla', 'bn_name' => 'কুমিল্লা', 'slug' => Str::slug('Cumilla', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
            ['id' => '12',  'district_id' => '62', 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'slug' => Str::slug('Mymensingh', '-'), 'category' => 'CC', 'lat' => '', 'lon' => '', 'url' => ''],
        ];
        DB::table('city_corporations')->insert($city_corporations);
    }
}
