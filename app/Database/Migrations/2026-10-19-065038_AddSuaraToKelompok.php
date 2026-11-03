<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSuaraToKelompok extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kelompok', [
            'suara' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => 1,
                'null'       => false,
                'comment'    => 'Jalur suara/display: 1 atau 2',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kelompok', 'suara');
    }
}