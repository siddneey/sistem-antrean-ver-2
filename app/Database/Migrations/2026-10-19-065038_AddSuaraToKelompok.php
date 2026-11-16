<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSuaraToKelompok extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        if (!$db->fieldExists('suara', 'kelompok')) {
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
    }

    public function down()
    {
        $db = \Config\Database::connect();

        if ($db->fieldExists('suara', 'kelompok')) {
            $this->forge->dropColumn('kelompok', 'suara');
        }
    }
}