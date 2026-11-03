<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIpAksesAndStatusLayar extends Migration
{
    public function up()
    {
        // Tabel ip_akses
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('ip_address');
        $this->forge->createTable('ip_akses');

        // Tabel status_layar
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kelompok_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'login_terakhir' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'last_seen' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('kelompok_id');
        $this->forge->addForeignKey(
            'kelompok_id',
            'kelompok',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('status_layar');
    }

    public function down()
    {
        // Hapus tabel yang memiliki foreign key terlebih dahulu
        $this->forge->dropTable('status_layar', true);
        $this->forge->dropTable('ip_akses', true);
    }
}