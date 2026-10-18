<?php

namespace App\Models;

use CodeIgniter\Model;

class IpAksesModel extends Model
{
    protected $table            = 'ip_akses';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'ip_address',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'ip_address' => 'required|valid_ip|max_length[45]',
    ];
}