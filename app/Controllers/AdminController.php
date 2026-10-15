<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function laporanProsesAntrean()
    {
        return view('admin/laporan_proses_antrean');
    }

    public function laporanRingkasanAntrean()
    {
        return view('admin/laporan_ringkasan_antrean');
    }
}