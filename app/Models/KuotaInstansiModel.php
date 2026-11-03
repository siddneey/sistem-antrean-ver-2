<?php

namespace App\Models;

use CodeIgniter\Model;

class KuotaInstansiModel extends Model
{
    protected $table = 'kuota_instansi';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'instansi_id',
        'tanggal',

        // Kompatibilitas data lama
        'kuota_biasa',
        'kuota_prioritas',

        // Pengaturan loket petugas
        'kuota_layanan',
        'kuota_booking',
        'status_loket',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
