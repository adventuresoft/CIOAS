<?php

if(! function_exists('family_constant_option')){
    function family_constant_option($option_name=null){
        $records = [
            'live_status' => [
                1 => 'Live',
                2 => 'Late',
                3 => 'Unknown',
            ],
            'marital_status' => [
                1 => 'Single',
                2 => 'Married',
                3 => 'Widowed',
                4 => 'Divorced',
                5 => 'Separated',
                6 => 'Engaged',
            ]
        ];
        if ($option_name) {
            return $records[$option_name];
        } else {
            return $records;
        }
        
    }
}

if(! function_exists('family_live_status')){
    function family_live_status($status=1){
        switch ($status) {
            case 1:
                return '';
                break;

            case 2:
                return 'Late';
                break;

            case 3:
                return 'Unknown';
                break;
            
            default:
                return '';
                break;
        }
    }
}
