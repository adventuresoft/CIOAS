<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MouzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mouzas = [
            ['id' => '1', 'thana_id' => '201', 'name' => 'Rayta', 'bn_name' => 'রায়টা', 'url' => ''],
            ['id' => '2', 'thana_id' => '201', 'name' => 'Fayjullapur', 'bn_name' => 'ফয়জুল্যাপুর', 'url' => ''],
            ['id' => '3', 'thana_id' => '201', 'name' => 'Horipur', 'bn_name' => 'হরিপুর', 'url' => ''],
            ['id' => '4', 'thana_id' => '201', 'name' => 'Meghnapara', 'bn_name' => 'মেঘনাপাড়া', 'url' => ''],
            ['id' => '5', 'thana_id' => '201', 'name' => 'Arkandi', 'bn_name' => 'আড়কান্দি', 'url' => ''],
            ['id' => '6', 'thana_id' => '201', 'name' => 'Madhobpur', 'bn_name' => 'মাধবপুর', 'url' => ''],
            ['id' => '7', 'thana_id' => '201', 'name' => 'Bashudebpur', 'bn_name' => 'বাসুদেবপুর', 'url' => ''],
            ['id' => '8', 'thana_id' => '201', 'name' => 'Bahadurpur', 'bn_name' => 'বাহাদুরপুর', 'url' => ''],
            ['id' => '9', 'thana_id' => '201', 'name' => 'Golapnogor', 'bn_name' => 'গোলাপনগর', 'url' => ''],
            ['id' => '10', 'thana_id' => '201', 'name' => 'Chor Golapnogor', 'bn_name' => 'চর গোলাপনগর', 'url' => ''],
            ['id' => '11', 'thana_id' => '201', 'name' => 'Arjisara', 'bn_name' => 'আরজিসারা', 'url' => ''],
            ['id' => '12', 'thana_id' => '201', 'name' => 'Chor Ruppur', 'bn_name' => 'চর রূপপুর', 'url' => ''],
            ['id' => '13', 'thana_id' => '201', 'name' => 'Chor Mokarimpur', 'bn_name' => 'চর মোকারিমপুর', 'url' => ''],
            ['id' => '14', 'thana_id' => '201', 'name' => 'Mokarimpur', 'bn_name' => 'মোকারিমপুর', 'url' => ''],
            ['id' => '15', 'thana_id' => '201', 'name' => 'Fakirabad', 'bn_name' => 'ফকিরাবাদ', 'url' => ''],
            ['id' => '16', 'thana_id' => '201', 'name' => 'Jhikri Porankhali', 'bn_name' => 'ঝিকড়ী পরান খালী', 'url' => ''],
            ['id' => '17', 'thana_id' => '201', 'name' => 'Dawlatpur', 'bn_name' => 'দৌলতপুর', 'url' => ''],
            ['id' => '18', 'thana_id' => '201', 'name' => 'Thakur Dawlatpur', 'bn_name' => 'ঠাকুর দৌলতপুর', 'url' => ''],
            ['id' => '19', 'thana_id' => '201', 'name' => 'Juniadaha', 'bn_name' => 'জুনিয়াদহ', 'url' => ''],
            ['id' => '20', 'thana_id' => '201', 'name' => 'Mirzapur', 'bn_name' => 'মির্জ্জাপুর', 'url' => ''],
            ['id' => '21', 'thana_id' => '201', 'name' => 'Dolua', 'bn_name' => 'দলুয়া', 'url' => ''],
            ['id' => '22', 'thana_id' => '201', 'name' => 'Gobindopur', 'bn_name' => 'গোবিন্দপুর', 'url' => ''],
            ['id' => '23', 'thana_id' => '201', 'name' => 'Nolua', 'bn_name' => 'নলুয়া', 'url' => ''],
            ['id' => '24', 'thana_id' => '201', 'name' => 'Patuakandi', 'bn_name' => 'পাটুয়াকান্দি', 'url' => ''],
            ['id' => '25', 'thana_id' => '201', 'name' => 'Jogossor', 'bn_name' => 'যগশ্বর', 'url' => ''],
            ['id' => '26', 'thana_id' => '201', 'name' => 'Poschima', 'bn_name' => 'পশ্চিমা', 'url' => ''],
            ['id' => '27', 'thana_id' => '201', 'name' => 'Nobogonga', 'bn_name' => 'নবগঙ্গা', 'url' => ''],
            ['id' => '28', 'thana_id' => '201', 'name' => 'Kazihata', 'bn_name' => 'কাজীহাটি', 'url' => ''],
            ['id' => '29', 'thana_id' => '201', 'name' => 'Dharampur', 'bn_name' => 'ধরমপুর', 'url' => ''],
            ['id' => '30', 'thana_id' => '201', 'name' => 'Satbaria', 'bn_name' => 'সাতবাড়িয়া', 'url' => ''],
            ['id' => '31', 'thana_id' => '201', 'name' => 'Nitarpol', 'bn_name' => 'নিতারপোল', 'url' => ''],
            ['id' => '32', 'thana_id' => '201', 'name' => 'Kodalipara', 'bn_name' => 'কোদালীয়াপাড়া', 'url' => ''],
            ['id' => '33', 'thana_id' => '201', 'name' => 'Himir Dia', 'bn_name' => 'হিড়িম দিয়া', 'url' => ''],
            ['id' => '34', 'thana_id' => '201', 'name' => 'Chandipur', 'bn_name' => 'চন্ডীপুর', 'url' => ''],
            ['id' => '35', 'thana_id' => '201', 'name' => 'Baradi', 'bn_name' => 'বাড়াদী', 'url' => ''],
            ['id' => '36', 'thana_id' => '201', 'name' => 'Chadgram', 'bn_name' => 'চাঁদ গ্রাম', 'url' => ''],
            ['id' => '37', 'thana_id' => '201', 'name' => 'Bamanpara', 'bn_name' => 'বামনপাড়া', 'url' => ''],
            ['id' => '38', 'thana_id' => '201', 'name' => 'Bheramara', 'bn_name' => 'ভেড়ামারা', 'url' => ''],
            ['id' => '39', 'thana_id' => '201', 'name' => 'Nawdapara', 'bn_name' => 'নওদাপাড়া', 'url' => ''],
            ['id' => '40', 'thana_id' => '201', 'name' => 'Chak Bheramara', 'bn_name' => 'চক ভেড়ামারা', 'url' => ''],
            ['id' => '41', 'thana_id' => '201', 'name' => 'Damukdua', 'bn_name' => 'দামুকদিয়া', 'url' => ''],
            ['id' => '42', 'thana_id' => '201', 'name' => 'Bahirchor Poschima', 'bn_name' => 'বাহিরচর পশ্চিম', 'url' => ''],
            ['id' => '43', 'thana_id' => '201', 'name' => 'West Chor Dadapur', 'bn_name' => 'ওয়েষ্ট চর দাদাপুর', 'url' => ''],

        ];

        DB::table('mouzas')->insert($mouzas);
        

    }
}
