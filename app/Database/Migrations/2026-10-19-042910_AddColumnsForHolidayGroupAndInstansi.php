<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsForHolidayGroupAndInstansi extends Migration
{
    public function up()
    {
        // Kolom tambahan hari_libur
        $this->forge->addColumn('hari_libur', [
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'tanggal',
            ],
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['Nasional', 'Khusus MPP'],
                'null'       => true,
                'after'      => 'nama',
            ],
        ]);

        // Kolom tambahan kelompok
        $this->forge->addColumn('kelompok', [
            'suara' => [
                'type'       => 'TINYINT',
                'unsigned'   => true,
                'default'    => 1,
                'comment'    => 'Jalur suara/display: 1 atau 2',
            ],
        ]);

        // Kolom tambahan instansi
        $this->forge->addColumn('instansi', [
            'audio_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'Aktif',
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('instansi', ['audio_nama', 'status']);
        $this->forge->dropColumn('kelompok', 'suara');
        $this->forge->dropColumn('hari_libur', ['nama', 'jenis']);
    }
}