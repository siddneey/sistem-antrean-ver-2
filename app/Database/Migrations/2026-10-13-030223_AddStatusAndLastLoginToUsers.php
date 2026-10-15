<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusAndLastLoginToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'Aktif',
                'null'       => false,
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'status',
            'last_login',
        ]);
    }
}