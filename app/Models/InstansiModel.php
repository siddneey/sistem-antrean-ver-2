<?php

namespace App\Models;

use CodeIgniter\Model;

class InstansiModel extends Model
{
    protected $table = 'instansi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'grup_id',
        'nama_instansi',
        'logo',
        'audio_nama',
    ];

    protected $useTimestamps = true;
}