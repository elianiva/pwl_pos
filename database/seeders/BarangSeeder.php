<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'barang_id' => $i + 1,
                'barang_kode' => fake()->lexify(),
                'barang_nama' => fake()->word(),
                'harga_beli' => fake()->randomNumber(5),
                'harga_jual' => fake()->randomNumber(5),
                'kategori_id' => fake()->randomElement([1, 2, 3, 4, 5]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('m_barang')->insert($data);
    }
}
