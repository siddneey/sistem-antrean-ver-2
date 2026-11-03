<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusPanggilanToKelompok extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kelompok', [
            'status_panggilan' => [
                'type'       => 'ENUM',
                'constraint' => ['IDLE', 'PLAYING'],
                'default'    => 'IDLE',
            ],
            'riwayat_panggilan_aktif_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'token_panggilan' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
            ],
            'batas_kunci' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kelompok', [
            'status_panggilan',
            'riwayat_panggilan_aktif_id',
            'token_panggilan',
            'batas_kunci',
        ]);
    }
}
