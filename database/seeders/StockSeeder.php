<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'stok_id' => $i + 1,
                'stok_kode' => fake()->lexify(),
                'stok_jumlah' => fake()->randomNumber(2),
                'barang_id' => fake()->randomElement([1, 2, 3, 4, 5]),
                'user_id' => fake()->randomElement([1, 2, 3]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('t_stok')->insert($data);
    }
}
