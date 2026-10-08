<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKuotaInstansiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'instansi_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'kuota_biasa' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'default'    => 50,
            ],
            'kuota_prioritas' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'default'    => 5,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addUniqueKey(
            ['instansi_id', 'tanggal'],
            'uq_kuota_instansi_tanggal'
        );

        $this->forge->addForeignKey(
            'instansi_id',
            'instansi',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->forge->createTable('kuota_instansi');
    }

    public function down()
    {
        $this->forge->dropTable('kuota_instansi', true);
    }
}