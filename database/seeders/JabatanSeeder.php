<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            'nama' => 'Admin',
            'kode' => 'ADM',
        ]);

        DB::table('jabatan')->insert([
            'nama' => 'Guru',
            'kode' => 'GRU',
        ]);
        DB::table('jabatan')->insert([
            'nama' => 'Guru Piket',
            'kode' => 'GRP',
        ]);
    }
}
