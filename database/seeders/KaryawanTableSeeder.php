<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawan')->insert([
            'nik' => 'KKI-000',
            'nama' => 'Admin',
            'email' => 'admin@kki.com',
            'password' => bcrypt('000000'),
            'level' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
