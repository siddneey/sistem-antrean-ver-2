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
            ],
            [
                'nama_kelompok' => 'Kelompok 2',
                'suara'         => 2,
            ],
        ];

        $builder = $this->db->table('kelompok');

        foreach ($data as $item) {
            $existing = $builder
                ->where('nama_kelompok', $item['nama_kelompok'])
                ->get()
                ->getRowArray();

            if ($existing) {
                $builder->where('id', $existing['id'])
                    ->update([
                        'suara'      => $item['suara'],
                        'updated_at' => $now,
                    ]);
            } else {
                $builder->insert([
                    'nama_kelompok' => $item['nama_kelompok'],
                    'suara'         => $item['suara'],
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);
            }
        }
    }
}