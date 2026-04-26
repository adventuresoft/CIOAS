<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $post_offices = array(
            array('id' => '550','thana_id' => '385','name' => 'Bedgram EDBO', 'postal_code' => '8100'),
            array('id' => '578','thana_id' => '385','name' => 'Boiltoli SO', 'postal_code' => '8104'),
            array('id' => '549','thana_id' => '385','name' => 'Bolakair EDBO', 'postal_code' => '8100'),
            array('id' => '569','thana_id' => '385','name' => 'Borfa SO', 'postal_code' => '8102'),
            array('id' => '551','thana_id' => '385','name' => 'Borni EDBO', 'postal_code' => '8100'),
            array('id' => '582','thana_id' => '385','name' => 'BSMRSTU SO', 'postal_code' => '8105'),
            array('id' => '573','thana_id' => '385','name' => 'Chandradigolia SO', 'postal_code' => '8103'),
            array('id' => '552','thana_id' => '385','name' => 'Charpukuria EDBO', 'postal_code' => '8100'),
            array('id' => '553','thana_id' => '385','name' => 'Darul Quran EDBO', 'postal_code' => '8100'),
            array('id' => '554','thana_id' => '385','name' => 'Degharkul EDBO', 'postal_code' => '8100'),
            array('id' => '555','thana_id' => '385','name' => 'Durgapur EDBO', 'postal_code' => '8100'),
            array('id' => '548','thana_id' => '385','name' => 'Gopalganj HO', 'postal_code' => '8100'),
            array('id' => '557','thana_id' => '385','name' => 'Gopalpur EDBO', 'postal_code' => '8100'),
            array('id' => '556','thana_id' => '385','name' => 'Gopalpur Pukuria EDBO', 'postal_code' => '8100'),
            array('id' => '574','thana_id' => '385','name' => 'Gopinathpur Kazi Para EDBO', 'postal_code' => '8103'),
            array('id' => '558','thana_id' => '385','name' => 'Kajulia EDBO', 'postal_code' => '8100'),
            array('id' => '560','thana_id' => '385','name' => 'Kathi EDBO', 'postal_code' => '8100'),
            array('id' => '559','thana_id' => '385','name' => 'Korpara EDBO', 'postal_code' => '8100'),
            array('id' => '575','thana_id' => '385','name' => 'Kutibari EDBO', 'postal_code' => '8103'),
            array('id' => '562','thana_id' => '385','name' => 'Majhigati High School EDBO', 'postal_code' => '8100'),
            array('id' => '563','thana_id' => '385','name' => 'Manikdah EDBO', 'postal_code' => '8100'),
            array('id' => '564','thana_id' => '385','name' => 'Manikhar EDBO', 'postal_code' => '8100'),
            array('id' => '576','thana_id' => '385','name' => 'Mari Gopinathpur EDBO', 'postal_code' => '8103'),
            array('id' => '561','thana_id' => '385','name' => 'Moddha Bonogram EDBO', 'postal_code' => '8100'),
            array('id' => '570','thana_id' => '385','name' => 'Molla Tetulia EDBO', 'postal_code' => '8102'),
            array('id' => '583','thana_id' => '385','name' => 'Mulashre EDBO', 'postal_code' => '8105'),
            array('id' => '585','thana_id' => '385','name' => 'Nilfaboira EDBO', 'postal_code' => '8105'),
            array('id' => '584','thana_id' => '385','name' => 'Pahardanga EDBO', 'postal_code' => '8105'),
            array('id' => '565','thana_id' => '385','name' => 'Raghunathpur EDBO', 'postal_code' => '8100'),
            array('id' => '579','thana_id' => '385','name' => 'Satpar EDBO', 'postal_code' => '8104'),
            array('id' => '566','thana_id' => '385','name' => 'Silna EDBO', 'postal_code' => '8100'),
            array('id' => '571','thana_id' => '385','name' => 'Suktail EDBO', 'postal_code' => '8102'),
            array('id' => '577','thana_id' => '385','name' => 'Sultanshahi EDBO', 'postal_code' => '8103'),
            array('id' => '580','thana_id' => '385','name' => 'Tuthamandra EDBO', 'postal_code' => '8104'),
            array('id' => '572','thana_id' => '385','name' => 'United Accademi Khalia EDBO', 'postal_code' => '8102'),
            array('id' => '581','thana_id' => '385','name' => 'Uttar Vennabari EDBO', 'postal_code' => '8104'),
            array('id' => '567','thana_id' => '385','name' => 'Verarhat EDBO', 'postal_code' => '8100'),
            array('id' => '568','thana_id' => '385','name' => 'Vojergati EDBO', 'postal_code' => '8100'),
        );

        DB::table('post_offices')->insert($post_offices);
    }
}
