<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $records = [
            [
                'role_id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'imran.molla@gmail.com',
                'password' => '$2y$10$rUUIMypaQ5YbINMCMRwGxuQeun7NxM2JEDeuJXFKJb2JfN9EClzAu',
                'status' => true,
                'created_by' => 1
            ],
            [
                'role_id' => 2,
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => '$2y$12$gDug6EvfGc.8dFY03ATE1uOLTJm8NHMgvMNAhdkPJFCTiRjbZvZuq',
                'status' => true,
                'created_by' => 1
            ],

            [
                'role_id' => 3,
                'name' => 'ENO',
                'username' => 'eno',
                'email' => 'admin1@gmail.com',
                'password' => '$2y$10$rUUIMypaQ5YbINMCMRwGxuQeun7NxM2JEDeuJXFKJb2JfN9EClzAu',
                'status' => true,
                'created_by' => 1
            ],

            [
                'role_id' => 4,
                'name' => 'Imran Molla',
                'username' => 'imran-molla',
                'email' => 'imran.molla@yahoo.com',
                'password' => Hash::make('Molla@2022!'),
                'status' => true,
                'created_by' => 1
            ]

        ];
        DB::table('users')->insert($records);
    }
}
