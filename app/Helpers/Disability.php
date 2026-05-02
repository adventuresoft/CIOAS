<?php

if(! function_exists('disability_constant_option')){
    function disability_constant_option($option_name=null){
        $records = [
            'disability_name' => [
                1 => 'Blind',
                2 => 'Broken',
            ],

            'disability_category' => [
                1 => 'Mid',
                2 => 'Latest'
            ]
            ,
            
            'disability_type' => [
                1 => 'By Birth',
                2 => 'By Accident',
            ],

             
            'treatment_status' => [
                1 => 'N/A',
                2 => 'DM',
                3 => 'Others',
            ]

        ];
        if ($option_name) {
            return $records[$option_name];
        } else {
            return $records;
        }
        
    }
}
