<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        $data = [
            ['name' => 'Bánh mặn', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bánh ngọt', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bánh trái cây', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bánh kem', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bánh crepe', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bánh Pizza', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bánh su kem', 'created_at' => $date, 'updated_at' => $date],
        ];

        DB::table('categories')->insert($data);
    }
}
