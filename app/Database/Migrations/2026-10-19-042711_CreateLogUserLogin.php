<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogUserLogin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'instansi_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'aktivitas' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Login Berhasil',
                    'Login Gagal',
                    'Logout',
                ],
            ],
            'alamat_ip' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'perangkat' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'waktu' => [
                'type'       => 'DATETIME',
                'default'    => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id', false, false, 'idx_user_id');
        $this->forge->addKey('instansi_id', false, false, 'idx_instansi_id');
        $this->forge->addKey('aktivitas', false, false, 'idx_aktivitas');
        $this->forge->addKey('waktu', false, false, 'idx_waktu');
        $this->forge->addKey('username', false, false, 'idx_username');

        $this->forge->createTable('log_user_login');
    }

    public function down()
    {
        $this->forge->dropTable('log_user_login', true);
    }
}