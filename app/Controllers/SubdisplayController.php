<?php

namespace App\Controllers;

use App\Services\SubdisplayService;
use RuntimeException;
use Throwable;

class SubdisplayController extends BaseController
{
    protected SubdisplayService $subdisplayService;

    public function __construct()
    {
        $this->subdisplayService = new SubdisplayService();
    }

    /**
     * GET /subdisplay
     * Halaman pemilihan grup.
     */
    public function index()
    {
        $db = db_connect();

        $grup = $db->table('grup g')
            ->select('
                g.id,
                g.nama_grup,
                g.kelompok_id,
                k.nama_kelompok
            ')
            ->join('kelompok k', 'k.id = g.kelompok_id', 'left')
            ->orderBy('g.kelompok_id', 'ASC')
            ->orderBy('g.nama_grup', 'ASC')
            ->get()
            ->getResultArray();

        $instansi = $db->table('instansi')
            ->select('id, grup_id, nama_instansi')
            ->orderBy('nama_instansi', 'ASC')
            ->get()
            ->getResultArray();

        $instansiPerGrup = [];

        foreach ($instansi as $item) {
            $grupId = (int) $item['grup_id'];
            $instansiPerGrup[$grupId][] = $item;
        }

        foreach ($grup as &$itemGrup) {
            $grupId = (int) $itemGrup['id'];

            $itemGrup['daftar_instansi'] =
                $instansiPerGrup[$grupId] ?? [];
        }

        unset($itemGrup);

        return view('subdisplay/pilih_grup', [
            'grup' => $grup,
        ]);
    }

    /**
     * GET /subdisplay/grup/{id}/layar
     * Dashboard Subdisplay berdasarkan grup.
     */
    public function layar($id)
    {
        $grupId = filter_var($id, FILTER_VALIDATE_INT);

        if ($grupId === false || $grupId < 1) {
            return redirect()
                ->to(site_url('subdisplay'))
                ->with('error', 'Grup tidak valid.');
        }

        try {
            $data = $this->subdisplayService
                ->getSubdisplayByGrup((int) $grupId);

            $grupAktif = $data['grup_aktif'] ?? null;

            if (!$grupAktif) {
                throw new RuntimeException('Grup tidak ditemukan.');
            }

            return view('subdisplay/index', [
                'grupId'      => (int) $grupAktif['id'],
                'grupAktif'   => $grupAktif,
                'apiUrl'      => site_url(
                    'subdisplay/grup/' . $grupAktif['id']
                ),
                'initialData' => $data,
            ]);

        } catch (RuntimeException $e) {
            return redirect()
                ->to(site_url('subdisplay'))
                ->with('error', $e->getMessage());

        } catch (Throwable $e) {
            log_message(
                'error',
                'SubdisplayController::layar: ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setBody('Gagal menampilkan Subdisplay.');
        }
    }

    /**
     * GET /subdisplay/grup/{id}
     * API polling data Subdisplay.
     */
    public function grup($id)
    {
        $grupId = filter_var($id, FILTER_VALIDATE_INT);

        if ($grupId === false || $grupId < 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'ID grup tidak valid.',
                ]);
        }

        try {
            $data = $this->subdisplayService
                ->getSubdisplayByGrup((int) $grupId);

            return $this->response->setJSON([
                'status' => true,
                'data'   => $data,
            ]);

        } catch (RuntimeException $e) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => false,
                    'message' => $e->getMessage(),
                ]);

        } catch (Throwable $e) {
            log_message(
                'error',
                'SubdisplayController::grup: ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal mengambil data Subdisplay.',
                ]);
        }
    }
}