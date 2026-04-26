<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['id' => '1', 'en_name' => 'Agrani Bank Limited', 'bn_name' => 'অগ্রণী ব্যাংক', 'created_by' => 1 ],
            ['id' => '2', 'en_name' => 'Bangladesh Development Bank', 'bn_name' => 'বাংলাদেশ ডেভেলপমেন্ট ব্যাংক লিমিটেড', 'created_by' => 1 ],
            ['id' => '3', 'en_name' => 'BASIC Bank Limited', 'bn_name' => 'বেসিক ব্যাংক লিমিটেড', 'created_by' => 1 ],
            ['id' => '4', 'en_name' => 'Janata Bank Limited', 'bn_name' => 'জনতা ব্যাংক লিমিটেড', 'created_by' => 1 ],
            ['id' => '5', 'en_name' => 'Rupali Bank Limited', 'bn_name' => ' রূপালী ব্যাংক', 'created_by' => 1 ],
            ['id' => '6', 'en_name' => 'Sonali Bank Limited', 'bn_name' => 'সোনালী ব্যাংক লিমিটেড', 'created_by' => 1 ]
        ];
        DB::table('banks')->insert($records);
    }
}
