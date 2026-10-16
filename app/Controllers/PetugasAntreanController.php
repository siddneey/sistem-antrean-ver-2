<?php

namespace App\Controllers;

use App\Services\PelayananService;
use Throwable;

class PetugasAntreanController extends BaseController
{
    protected PelayananService $pelayananService;

    public function __construct()
    {
        $this->pelayananService = new PelayananService();
    }

    /**
     * GET /petugas/antrean
     *
     * Menampilkan antrean pada instansi petugas.
     */
    public function index()
    {
        $petugasId = (int) session()->get('user_id');

        if ($petugasId <= 0) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Sesi petugas tidak ditemukan.',
                ]);
        }

        try {
            $data = $this->pelayananService
                ->getAntreanPetugas($petugasId);

            return $this->response->setJSON([
                'status' => true,
                'data'   => $data,
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * POST /petugas/antrean/panggil
     *
     * Memanggil antrean berikutnya.
     *
     * JSON:
     * {
     *     "instansi_id": 5
     * }
     */
    public function panggil()
    {
        $petugasId = (int) session()->get('user_id');
        $input = $this->request->getJSON(true) ?? [];

        if ($petugasId <= 0) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Sesi petugas tidak ditemukan.',
                ]);
        }

        $instansiId = filter_var(
            $input['instansi_id'] ?? null,
            FILTER_VALIDATE_INT
        );

        if ($instansiId === false || $instansiId < 1) {
            return $this->badRequest(
                'instansi_id wajib diisi dengan ID yang valid.'
            );
        }

        try {
            $data = $this->pelayananService->panggilAntrean(
                $petugasId,
                (int) $instansiId
            );

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Antrean berhasil dipanggil.',
                'data'    => $data,
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * POST /petugas/antrean/status
     *
     * Mengubah status antrean menjadi SELESAI atau PENDING.
     *
     * JSON untuk PENDING:
     * {
     *     "riwayat_layanan_id": 3,
     *     "status": "PENDING",
     *     "keterangan": "Ditunda sementara"
     * }
     *
     * JSON untuk SELESAI:
     * {
     *     "riwayat_layanan_id": 3,
     *     "status": "SELESAI",
     *     "layanan_id": 1,
     *     "keterangan": "Pelayanan selesai"
     * }
     */
    public function konfirmasiStatus()
    {
        $petugasId = (int) session()->get('user_id');
        $input = $this->request->getJSON(true);

        if ($petugasId <= 0) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Sesi petugas tidak ditemukan.',
                ]);
        }

        if (!is_array($input)) {
            return $this->badRequest(
                'Request JSON tidak valid.'
            );
        }

        $riwayatLayananId = filter_var(
            $input['riwayat_layanan_id'] ?? null,
            FILTER_VALIDATE_INT
        );

        $status = strtoupper(
            trim((string) ($input['status'] ?? ''))
        );

        $layananId = null;

        if (array_key_exists('layanan_id', $input)) {
            $layananId = filter_var(
                $input['layanan_id'],
                FILTER_VALIDATE_INT
            );

            if ($layananId === false || $layananId < 1) {
                return $this->badRequest(
                    'layanan_id tidak valid.'
                );
            }
        }

        $keterangan = array_key_exists('keterangan', $input)
            ? trim((string) $input['keterangan'])
            : null;

        if (
            $riwayatLayananId === false
            || $riwayatLayananId < 1
        ) {
            return $this->badRequest(
                'riwayat_layanan_id wajib diisi dengan ID yang valid.'
            );
        }

        if (!in_array($status, ['SELESAI', 'PENDING'], true)) {
            return $this->badRequest(
                'status harus SELESAI atau PENDING.'
            );
        }

        if ($status === 'SELESAI' && $layananId === null) {
            return $this->badRequest(
                'layanan_id wajib diisi untuk status SELESAI.'
            );
        }

        try {
            /*
             * PENTING:
             * Urutan parameter harus:
             * petugasId, riwayatLayananId, status,
             * layananId, keterangan.
             */
            $data = $this->pelayananService->konfirmasiStatus(
                $petugasId,
                (int) $riwayatLayananId,
                $status,
                $layananId === null ? null : (int) $layananId,
                $keterangan
            );

            return $this->response->setJSON([
                'status'  => true,
                'message' => $status === 'SELESAI'
                    ? 'Antrean berhasil diselesaikan.'
                    : 'Antrean berhasil dipindahkan ke pending.',
                'data' => $data,
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * POST /petugas/antrean/panggil-pending
     *
     * Memanggil kembali antrean yang berstatus PENDING.
     *
     * JSON:
     * {
     *     "riwayat_layanan_id": 3
     * }
     */
    public function panggilPending()
    {
        $petugasId = (int) session()->get('user_id');
        $input = $this->request->getJSON(true);

        if ($petugasId <= 0) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Sesi petugas tidak ditemukan.',
                ]);
        }

        if (!is_array($input)) {
            return $this->badRequest(
                'Request JSON tidak valid.'
            );
        }

        $riwayatLayananId = filter_var(
            $input['riwayat_layanan_id'] ?? null,
            FILTER_VALIDATE_INT
        );

        if (
            $riwayatLayananId === false
            || $riwayatLayananId < 1
        ) {
            return $this->badRequest(
                'riwayat_layanan_id wajib diisi dengan ID yang valid.'
            );
        }

        try {
            $data = $this->pelayananService->panggilPending(
                $petugasId,
                (int) $riwayatLayananId
            );

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Antrean pending berhasil dipanggil kembali.',
                'data'    => $data,
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Respons untuk input yang tidak valid.
     */
    protected function badRequest(string $message)
    {
        return $this->response
            ->setStatusCode(400)
            ->setJSON([
                'status'  => false,
                'message' => $message,
            ]);
    }

    /**
     * Respons error.
     *
     * Catatan:
     * Detail exception ditulis ke log server,
     * bukan ditampilkan langsung ke client.
     */
    protected function errorResponse(Throwable $e)
    {
        log_message(
            'error',
            '[PetugasAntreanController] {message}',
            ['message' => $e->getMessage()]
        );

        $message = $e->getMessage();

        // Error bisnis yang umum ditampilkan ke client.
        $businessErrors = [
            'Riwayat layanan tidak ditemukan.',
            'Antrean ini bukan tanggung jawab petugas tersebut.',
            'Petugas tidak ditemukan.',
            'User tersebut bukan petugas.',
            'Petugas tidak terdaftar pada instansi tersebut.',
            'Antrean tidak sedang dilayani.',
            'Antrean tidak berstatus pending.',
            'Antrean tidak dapat dipanggil.',
            'Layanan tidak ditemukan.',
            'Layanan tidak tersedia pada instansi tersebut.',
            'Status hanya dapat berupa SELESAI atau PENDING.',
        ];

        if (in_array($message, $businessErrors, true)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => $message,
                ]);
        }

        return $this->response
            ->setStatusCode(500)
            ->setJSON([
                'status'  => false,
                'message' => 'Terjadi kesalahan saat memproses antrean.',
            ]);
    }
}