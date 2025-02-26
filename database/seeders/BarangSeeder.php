<?php

namespace Database\Seeders;

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
        $data = [
            ['Barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Nasi Goreng', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['Barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Capjay', 'harga_beli' => 8000, 'harga_jual' => 12000],
            ['Barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'B003', 'barang_nama' => 'Es Teh', 'harga_beli' => 3000, 'harga_jual' => 5000],
            ['Barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'B004', 'barang_nama' => 'Jus Alpukat', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['Barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'B005', 'barang_nama' => 'Handphone', 'harga_beli' => 5000000, 'harga_jual' => 5500000],
            ['Barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'B006', 'barang_nama' => 'Laptop', 'harga_beli' => 20000000, 'harga_jual' => 21000000],
            ['Barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'B007', 'barang_nama' => 'Kaos Polos', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['Barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'B008', 'barang_nama' => 'Jaket Hoodie', 'harga_beli' => 300000, 'harga_jual' => 400000],
            ['Barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'B009', 'barang_nama' => 'Blender', 'harga_beli' => 300000, 'harga_jual' => 400000],
            ['Barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'B010', 'barang_nama' => 'Kompor Gas', 'harga_beli' => 400000, 'harga_jual' => 500000],
        ];

        DB::table('m_barang')->insert($data);
    }
}
