<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelompokSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'nama_kelompok' => 'Kelompok 1',
                'suara'         => 1,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'nama_kelompok' => 'Kelompok 2',
                'suara'         => 2,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        $this->db->table('kelompok')->insertBatch($data);
    }
}