<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => '#1',
        ]);
        for ($i = 2; $i <= 10; $i++) {
            $data = [
                'name' => '#' . $i,
            ];
        
            if ($i % 2 == 0 && $i != 1) {
                $data['category_id'] = $i - 1;
            }
        
            DB::table('categories')->insert($data);
        }
    }
}
