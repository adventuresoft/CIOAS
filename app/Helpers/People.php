<?php

if(! function_exists('people_constant_option')){
    function people_constant_option($option_name=null){
        $records = [
            'birth_place' => [
                1 => 'Inside of Country',
                2 => 'Outside of Country',
            ],
            'gender' => [
                1 => 'Male',
                2 => 'Female',
                3 => 'Others'
            ],
            'religion' => [
                1 => 'Muslim',
                2 => 'Hinduism',
                3 => 'Buddhism',
                4 => 'Christianity',
                5 => 'Others'
            ],

            'blood_group' => [
                1 => 'A+',
                2 => 'A-',
                3 => 'B+',
                4 => 'B-',
                5 => 'AB+',
                6 => 'AB-',
                7 => 'O+',
                8 => 'O-'
            ],

        ];
        if ($option_name) {
            return $records[$option_name];
        } else {
            return $records;
        }
        
    }
}
