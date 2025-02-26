<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'Arka', 'penjualan_kode' => 'P001', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 2, 'user_id' => 2, 'pembeli' => 'Xavier', 'penjualan_kode' => 'P002', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Majid', 'penjualan_kode' => 'P003', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 4, 'user_id' => 1, 'pembeli' => 'Majid', 'penjualan_kode' => 'P004', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 5, 'user_id' => 2, 'pembeli' => 'Seno', 'penjualan_kode' => 'P005', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 6, 'user_id' => 3, 'pembeli' => 'Baihaqi', 'penjualan_kode' => 'P006', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 7, 'user_id' => 1, 'pembeli' => 'Febrian', 'penjualan_kode' => 'P007', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 8, 'user_id' => 2, 'pembeli' => 'Kevin', 'penjualan_kode' => 'P008', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Khen', 'penjualan_kode' => 'P009', 'penjualan_tanggal' => Carbon::now()],
            ['penjualan_id' => 10, 'user_id' => 1, 'pembeli' => 'Aqilla', 'penjualan_kode' => 'P010', 'penjualan_tanggal' => Carbon::now()],
        ];

        DB::table('t_penjualan')->insert($data); 
    }
}
