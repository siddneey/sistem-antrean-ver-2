<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InstansiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Grup 1
            ['grup_id' => 1, 'nama_instansi' => 'SAMSAT'],
            ['grup_id' => 1, 'nama_instansi' => 'BPJS KESEHATAN'],
            ['grup_id' => 1, 'nama_instansi' => 'DISNAKER'],
            ['grup_id' => 1, 'nama_instansi' => 'ATR BPN'],

            // Grup 2
            ['grup_id' => 2, 'nama_instansi' => 'BAPENDA'],
            ['grup_id' => 2, 'nama_instansi' => 'BPKD'],
            ['grup_id' => 2, 'nama_instansi' => 'BPJS TK'],
            ['grup_id' => 2, 'nama_instansi' => 'KEJARI'],

            // Grup 3
            ['grup_id' => 3, 'nama_instansi' => 'DUKCAPIL'],
            ['grup_id' => 3, 'nama_instansi' => 'DITJEN AHU'],
            ['grup_id' => 3, 'nama_instansi' => 'PENGADILAN AGAMA'],
            ['grup_id' => 3, 'nama_instansi' => 'PELAYANAN PBG'],

            // Grup 4
            ['grup_id' => 4, 'nama_instansi' => 'DPUPR'],
            ['grup_id' => 4, 'nama_instansi' => 'PERKIM'],
            ['grup_id' => 4, 'nama_instansi' => 'DISHUB'],
            ['grup_id' => 4, 'nama_instansi' => 'BNN'],

            // Grup 5
            ['grup_id' => 5, 'nama_instansi' => 'POLRES'],
            ['grup_id' => 5, 'nama_instansi' => 'PT. POS INDONESIA'],
            ['grup_id' => 5, 'nama_instansi' => 'TASPEN'],
            ['grup_id' => 5, 'nama_instansi' => 'PLN'],
            ['grup_id' => 5, 'nama_instansi' => 'PDAM'],

            // Grup 6
            ['grup_id' => 6, 'nama_instansi' => 'BPOM'],
            ['grup_id' => 6, 'nama_instansi' => 'DINAS LINGKUNGAN HIDUP'],
            ['grup_id' => 6, 'nama_instansi' => 'PTSP 1'],
            ['grup_id' => 6, 'nama_instansi' => 'PTSP 2'],

            // Grup 7
            ['grup_id' => 7, 'nama_instansi' => 'BANK BANTEN'],

            // Grup 8
            ['grup_id' => 8, 'nama_instansi' => 'BANK BJB'],
            ['grup_id' => 8, 'nama_instansi' => 'BAZNAS'],
        ];

        $builder = $this->db->table('instansi');
        $now = date('Y-m-d H:i:s');

        foreach ($data as $item) {
            $existing = $builder
                ->where('nama_instansi', $item['nama_instansi'])
                ->get()
                ->getRowArray();

            if ($existing) {
                // Update hanya grup dan updated_at.
                // audio_nama sengaja tidak disentuh.
                $builder->where('id', $existing['id'])
                    ->update([
                        'grup_id'    => $item['grup_id'],
                        'updated_at' => $now,
                    ]);
            } else {
                $builder->insert([
                    'grup_id'       => $item['grup_id'],
                    'nama_instansi' => $item['nama_instansi'],
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);
            }
        }
    }
}