<?php


if(! function_exists('profession_constant_option')){
    function profession_constant_option($option_name=null){
        $records = [

            // Step 1
            'professions' => [
                1 => 'Job',
                2 => 'Business',
                3 => 'Professional',
                4 => 'Student',
                5 => 'Freelancing'
            ],


            // Step 2
            'jobType' => [
                1 => 'Government',
                2 => 'Private',
            ],

            'businessType' => [
                1 => 'Small',
                2 => 'Medium',
                3 => 'Large'
            ],

            'professionalType' => [
                1 => 'Lawyer',
                2 => 'Journalist'
            ],

            'studentType' => [
                1 => 'General',
                2 => 'Technical',
                3 => 'Madrasa',
            ],

            'freelancingType' => [
                1 => 'IT',
                2 => 'Others',
            ],



            // Step 3
            'governmentCategory' => [
                1 => 'Cadre',
                2 => 'Non Cadre',
                3 => 'Defense Forces'
            ],

            'privateCategory' => [
                1 => 'National',
                2 => 'Multinational',
            ],

            'businessCategory' => [
                1 => 'Manufacturer',
                2 => 'Seller',
                3 => 'Agent',
                4 => 'Export & Import'
            ]



            
            
        ];

        if ($option_name) {
            return $records[$option_name];
        } else {
            return $records;
        }
        
    }
}



?>