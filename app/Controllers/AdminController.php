<?php

namespace App\Controllers;

use App\Services\DisplayService;
use RuntimeException;
use Throwable;

class AdminController extends BaseController
{
    protected DisplayService $displayService;

    public function __construct()
    {
        $this->displayService = new DisplayService();
    }

    /** GET /display — pilih kelompok. */
    public function index()
    {
        try {
            $db = db_connect();
            $kelompok = $db->table('kelompok')
                ->select('id, nama_kelompok, suara')
                ->orderBy('id', 'ASC')->get()->getResultArray();
            $grup = $db->table('grup')
                ->select('id, nama_grup, kelompok_id')
                ->orderBy('kelompok_id', 'ASC')->orderBy('id', 'ASC')
                ->get()->getResultArray();
            return view('display/pilih_kelompok', compact('kelompok', 'grup'));
        } catch (Throwable $e) {
            log_message('error', 'DisplayController::index | ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setBody('Gagal memuat pilihan display.');
        }
    }

    /** GET /display/layar/{id} — halaman display fisik kelompok. */
    public function layar($id)
    {
        $kelompokId = filter_var($id, FILTER_VALIDATE_INT);
        if ($kelompokId === false || $kelompokId < 1) {
            return $this->response->setStatusCode(400)->setBody('ID kelompok tidak valid.');
        }
        try {
            $data = $this->displayService->getDisplayByKelompok($kelompokId);
            return view('display/index', [
                'kelompokId' => $kelompokId,
                'initialData' => $data,
            ]);
        } catch (RuntimeException $e) {
            return $this->response->setStatusCode(404)->setBody(esc($e->getMessage()));
        } catch (Throwable $e) {
            log_message('error', 'DisplayController::layar | ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setBody('Gagal memuat layar display.');
        }
    }

    /** GET /display/kelompok/{id} — API JSON untuk polling. */
    public function kelompok($id)
    {
        $kelompokId = filter_var($id, FILTER_VALIDATE_INT);
        if ($kelompokId === false || $kelompokId < 1) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false, 'message' => 'ID kelompok tidak valid.',
            ]);
        }
        try {
            return $this->response->setJSON([
                'status' => true,
                'data' => $this->displayService->getDisplayByKelompok($kelompokId),
            ]);
        } catch (RuntimeException $e) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false, 'message' => $e->getMessage(),
            ]);
        } catch (Throwable $e) {
            log_message('error', 'DisplayController::kelompok | ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false, 'message' => 'Gagal mengambil data display.',
            ]);
        }
    }
}