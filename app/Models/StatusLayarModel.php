<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusLayarModel extends Model
{
    protected $table            = 'status_layar';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'kelompok_id',
        'login_terakhir',
        'last_seen',
    ];

    protected $useTimestamps = false;
}