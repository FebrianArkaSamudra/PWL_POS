<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_supplier')->insert([
            [
                'nama_supplier' => 'PT. Sumber Makmur',
                'email' => 'sumbermakmur@example.com',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_supplier' => 'CV. Maju Jaya',
                'email' => 'majuyaya@example.com',
                'telepon' => '081987654321',
                'alamat' => 'Jl. Raya Bandung No. 45, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_supplier' => 'UD. Sejahtera',
                'email' => 'sejahtera@example.com',
                'telepon' => '081112223344',
                'alamat' => 'Jl. Pahlawan No. 67, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}