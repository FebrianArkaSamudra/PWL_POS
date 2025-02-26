<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['detail_id' => 1, 'penjualan_id' => 1, 'barang_id' => 1, 'harga' => 10000, 'jumlah' => 10],
            ['detail_id' => 2, 'penjualan_id' => 2, 'barang_id' => 2, 'harga' => 15000, 'jumlah' => 15],
            ['detail_id' => 3, 'penjualan_id' => 3, 'barang_id' => 3, 'harga' => 20000, 'jumlah' => 20],
            ['detail_id' => 4, 'penjualan_id' => 4, 'barang_id' => 4, 'harga' => 25000, 'jumlah' => 25],
            ['detail_id' => 5, 'penjualan_id' => 5, 'barang_id' => 5, 'harga' => 30000, 'jumlah' => 30],
            ['detail_id' => 6, 'penjualan_id' => 6, 'barang_id' => 6, 'harga' => 35000, 'jumlah' => 35],
            ['detail_id' => 7, 'penjualan_id' => 7, 'barang_id' => 7, 'harga' => 40000, 'jumlah' => 40],
            ['detail_id' => 8, 'penjualan_id' => 8, 'barang_id' => 8, 'harga' => 45000, 'jumlah' => 45],
            ['detail_id' => 9, 'penjualan_id' => 9, 'barang_id' => 9, 'harga' => 50000, 'jumlah' => 50],
            ['detail_id' => 10, 'penjualan_id' => 10, 'barang_id' => 10, 'harga' => 60000, 'jumlahl' => 55],
            ['detail_id' => 11,'penjualan_id' => 1, 'barang_id' => 1, 'harga' => 65000, 'jumlah' => 60],
            ['detail_id' => 12, 'penjualan_id' => 2, 'barang_id' => 2, 'harga' => 70000, 'jumlah' => 65],
            ['detail_id' => 13, 'penjualan_id' => 3, 'barang_id' => 3, 'harga' => 75000, 'jumlah' => 70],
            ['detail_id' => 14, 'penjualan_id' => 4, 'barang_id' => 4, 'harga' => 80000, 'jumlah' => 75],
            ['detail_id' => 15, 'penjualan_id' => 5, 'barang_id' => 5, 'harga' => 85000, 'jumlah' => 80],
            ['detail_id' => 16, 'penjualan_id' => 6, 'barang_id' => 6, 'harga' => 90000, 'jumlah' => 85],
            ['detail_id' => 17,'penjualan_id' => 7, 'barang_id' => 7, 'harga' => 95000, 'jumlah' => 90],
            ['detail_id' => 18, 'penjualan_id' => 8, 'barang_id' => 8, 'harga' => 100000, 'jumlah' => 95],
            ['detail_id' => 19, 'penjualan_id' => 9, 'barang_id' => 9, 'harga' => 105000, 'jumlah' => 100],
            ['detail_id' => 20, 'penjualan_id' => 10, 'barang_id' => 10, 'harga' => 110000, 'jumlahl' => 105],
            ['detail_id' => 21, 'penjualan_id' => 1, 'barang_id' => 1, 'harga' => 115000, 'jumlah' => 110],
            ['detail_id' => 22, 'penjualan_id' => 2, 'barang_id' => 2, 'harga' => 120000, 'jumlah' => 115],
            ['detail_id' => 23, 'penjualan_id' => 3, 'barang_id' => 3, 'harga' => 125000, 'jumlah' => 120],
            ['detail_id' => 24, 'penjualan_id' => 4, 'barang_id' => 4, 'harga' => 130000, 'jumlah' => 125],
            ['detail_id' => 25, 'penjualan_id' => 5, 'barang_id' => 5, 'harga' => 135000, 'jumlah' => 130],
            ['detail_id' => 26, 'penjualan_id' => 6, 'barang_id' => 6, 'harga' => 140000, 'jumlah' => 135],
            ['detail_id' => 27, 'penjualan_id' => 7, 'barang_id' => 7, 'harga' => 145000, 'jumlah' => 140],
            ['detail_id' => 28, 'penjualan_id' => 8, 'barang_id' => 8, 'harga' => 150000, 'jumlah' => 145],
            ['detail_id' => 29, 'penjualan_id' => 9, 'barang_id' => 9, 'harga' => 155000, 'jumlah' => 150],
            ['detail_id' => 30, 'penjualan_id' => 10, 'barang_id' => 10, 'harga' => 160000, 'jumlahl' => 155],
        ];

        DB::table('t_penjualan_detail')->insert($data); 
    }
}
