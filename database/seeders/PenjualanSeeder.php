<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'penjualan_id' => $i + 1,
                'pembeli' => fake()->name(),
                'penjualan_kode' => fake()->lexify(),
                'penjualan_tanggal' => fake()->dateTimeBetween('-1 month'),
                'user_id' => fake()->randomElement([1, 2, 3]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('t_penjualan')->insert($data);
    }
}
