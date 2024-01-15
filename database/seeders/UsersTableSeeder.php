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
                'password' => Hash::make('123456'),
                'role' => '1',
            ],
            [
                'name' => 'Osama Client 1',
                'email' => 'osama2@example.com',
                'password' => Hash::make('123456'),
                'role' => '2',
            ],
            [
                'name' => 'Osama Client 2',
                'email' => 'osama3@example.com',
                'password' => Hash::make('123456'),
                'role' => '2',
            ],
        ];
        
        foreach ($usersData as $userData) {
            DB::table('users')->insert($userData);
        }
    }
}
