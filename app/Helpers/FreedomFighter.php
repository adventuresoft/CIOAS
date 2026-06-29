<?php

if(! function_exists('freedom_fighter_constant_option')){
    function freedom_fighter_constant_option($option_name=null){
        $records = [
            'area' => [
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
                6 => '6',
                7 => '7',
                8 => '8',
                9 => '9',
                10 => '10',
                11 => '11',
            ],

            'designation' => [
                1 => 'Bir Sreshtho',
                2 => 'Bir Uttom',
                3 => 'Bir Bikrom',
                4 => 'Bir Protik',
                5 => 'FREEDOM FIGHTER'
            ]
            ,
            
            'type' => [
                1 => 'Fighter',
                2 => 'Help',
            ],

            'july_category' => [
                1 => 'Martyr (শহীদ)',
                2 => 'Injured (আহত)',
            ],

        ];
        if ($option_name) {
            return $records[$option_name];
        } else {
            return $records;
        }
        
    }
}
