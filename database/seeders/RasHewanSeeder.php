<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RasHewanSeeder extends Seeder
{
    public function run()
    {
        DB::table('ras_hewan')->insert([
            ['id' => 1, 'nama_ras' => 'Persia', 'jenis_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_ras' => 'Anggora', 'jenis_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_ras' => 'Golden Retriever', 'jenis_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_ras' => 'Bulldog', 'jenis_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama_ras' => 'Parrot', 'jenis_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
