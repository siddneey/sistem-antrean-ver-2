<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDisplayMonitoringToKelompok extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kelompok', [
            'display_heartbeat_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'display_audio_ready' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => true,
                'default' => 0,
            ],
            'display_session_token' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kelompok', [
            'display_heartbeat_at',
            'display_audio_ready',
            'display_session_token',
        ]);
    }
}
