<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('RolesSeeder');
        $this->call('KelompokSeeder');
        $this->call('GrupSeeder');
        $this->call('InstansiSeeder');
        $this->call('LayananSeeder');
        $this->call('UsersSeeder');
    }
}