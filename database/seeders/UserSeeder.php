<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert(
        //     [
        //         'names' => 'Imanzi Creations',
        //         'email' => 'imanzi.rw@gmail.com',
        //         'phone' => '0788334964',
        //         'address' => 'Kimironko-Kigali-Rwanda',
        //         'city' => 'Kigali',
        //         'country' => 'Rwanda',
        //         'zipCode' => '34569',
        //         'role' => 'admin',
        //         'password' => Hash::make('changinglives')
        //     ]
        // );
        DB::table('users')->insert(
            [
                'names' => 'Francois',
                'email' => 'mjeanfrancois360@gmail.com',
                'phone' => '0784324234',
                'address' => 'Kimironko-Kigali-Rwanda',
                'city' => 'Kigali',
                'country' => 'Rwanda',
                'zipCode' => '34569',
                'role' => 'artist',
                'password' => Hash::make('User@123!')
            ]
        );
    }
}
