<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('posts')->insert([
                'title' => 'Title #'. $i,
                'author' => 2,
                'category_id' => $i,
                'text' => 'This text is replaceable with any text you desire. Feel free to modify it as needed to suit your requirements.',
                'image' => 'test_image'
            ]);
        }
    }
}
