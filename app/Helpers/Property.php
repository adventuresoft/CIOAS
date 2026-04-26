<?php


if(! function_exists('property_constant_option')){
    function property_constant_option($option_name=null){
        $records = [

            'diamondType' => [
                1 => 'Raw',
                2 => 'Ornament',
            ],

            'goldType' => [
                1 => 'Raw',
                2 => 'Ornament',
            ],

            'silverType' => [
                1 => 'Raw',
                2 => 'Ornament',
            ],
            
        ];

        if ($option_name) {
            return $records[$option_name];
        } else {
            return $records;
        }
        
    }
}



?>