<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['id' => '1', 'en_name' => 'Current Account', 'bn_name' => 'চলিত', 'created_by' => 1 ],
            ['id' => '2', 'en_name' => 'Saving Account', 'bn_name' => 'সেভিংস', 'created_by' => 1 ]
        ];
        DB::table('account_types')->insert($records);
    }
}
