<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisHewanSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis_hewan')->insert([
            ['id' => 1, 'nama_jenis' => 'Kucing', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_jenis' => 'Anjing', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_jenis' => 'Burung', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
