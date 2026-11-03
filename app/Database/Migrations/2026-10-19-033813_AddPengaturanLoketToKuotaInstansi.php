<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPengaturanLoketToKuotaInstansi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kuota_instansi', [
            'kuota_layanan' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'default'    => 100,
                'after'      => 'kuota_prioritas',
            ],
            'kuota_booking' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'default'    => 30,
                'after'      => 'kuota_layanan',
            ],
            'status_loket' => [
                'type'       => 'ENUM',
                'constraint' => ['BUKA', 'TUTUP'],
                'default'    => 'BUKA',
                'after'      => 'kuota_booking',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kuota_instansi', [
            'kuota_layanan',
            'kuota_booking',
            'status_loket',
        ]);
    }
}