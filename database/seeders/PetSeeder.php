<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    public function run()
    {
        DB::table('pet')->insert([
            ['id' => 1, 'nama_pet' => 'Milo', 'jenis' => 'Kucing', 'ras' => 'Persia', 'pemilik_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_pet' => 'Buddy', 'jenis' => 'Anjing', 'ras' => 'Golden Retriever', 'pemilik_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_pet' => 'Coco', 'jenis' => 'Burung', 'ras' => 'Parrot', 'pemilik_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_pet' => 'Luna', 'jenis' => 'Kucing', 'ras' => 'Anggora', 'pemilik_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama_pet' => 'Rocky', 'jenis' => 'Anjing', 'ras' => 'Bulldog', 'pemilik_id' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
