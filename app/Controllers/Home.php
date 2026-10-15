<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('is_logged_in')) {
            if ((int) session()->get('role_id') === 1) {
                return redirect()->to(site_url('admin/dashboard'));
            }

            if ((int) session()->get('role_id') === 2) {
                return redirect()->to(site_url('petugas/dashboard'));
            }
        }

        return view('auth/login');
    }
}