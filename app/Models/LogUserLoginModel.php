<?php

namespace App\Models;

use CodeIgniter\Model;

class LogUserLoginModel extends Model
{
    /**
     * ============================================================
     * KONFIGURASI TABEL
     * ============================================================
     */
    protected $table            = 'log_user_login';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    /**
     * ============================================================
     * KOLOM YANG BOLEH DISIMPAN
     * ============================================================
     */
    protected $allowedFields = [
        'user_id',
        'username',
        'instansi_id',
        'aktivitas',
        'alamat_ip',
        'perangkat',
        'waktu',
    ];

    /**
     * ============================================================
     * TIMESTAMP
     * ============================================================
     *
     * Kolom waktu diisi oleh database secara otomatis.
     */
    protected $useTimestamps = false;
}