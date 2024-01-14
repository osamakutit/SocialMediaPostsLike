<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'Osama Admin',
                'email' => 'osama@example.com',
                'password' => Hash::make('123'),
                'role' => '1',
            ],
            [
                'name' => 'Osama Author',
                'email' => 'osama2@example.com',
                'password' => Hash::make('123'),
                'role' => '2',
            ],
            [
                'name' => 'Osama Client',
                'email' => 'osama3@example.com',
                'password' => Hash::make('123'),
                'role' => '3',
            ],
        ];
        
        foreach ($usersData as $userData) {
            DB::table('users')->insert($userData);
        }
    }
}
