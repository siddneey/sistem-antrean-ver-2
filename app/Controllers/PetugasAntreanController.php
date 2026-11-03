<?php

namespace App\Controllers;

use App\Services\PelayananService;
use RuntimeException;
use Throwable;

class PetugasAntreanController extends BaseController
{
    protected PelayananService $pelayananService;

    public function __construct()
    {
        $this->pelayananService = new PelayananService();
    }

    private function petugasId(): int
    {
        if ((int) session()->get('role_id') !== 2) {
            throw new RuntimeException('Akses petugas ditolak.');
        }

        $id = (int) session()->get('user_id');

        if ($id < 1) {
            throw new RuntimeException(
                'Sesi petugas tidak ditemukan.'
            );
        }

        return $id;
    }

    private function input(): array
    {
        $data = $this->request->getJSON(true);

        if (!is_array($data)) {
            throw new RuntimeException(
                'Request JSON tidak valid.'
            );
        }

        return $data;
    }

    private function angka(array $input, string $key): int
    {
        $nilai = filter_var(
            $input[$key] ?? null,
            FILTER_VALIDATE_INT
        );

        if ($nilai === false || $nilai < 1) {
            throw new RuntimeException(
                $key . ' wajib berupa ID positif.'
            );
        }

        return (int) $nilai;
    }

    private function jalankan(callable $callback)
    {
        try {
            $data = $callback();

            return $this->response->setJSON([
                'status' => true,
                'data' => $data,
                'csrfHash' => csrf_hash(),
            ]);

        } catch (RuntimeException $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'csrfHash' => csrf_hash(),
                ]);

        } catch (Throwable $e) {
            log_message(
                'error',
                '[PetugasAntrean] {message}',
                ['message' => $e->getMessage()]
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => false,
                    'message' => 'Terjadi kesalahan saat memproses antrean.',
                    'csrfHash' => csrf_hash(),
                ]);
        }
    }

    /**
     * GET /petugas/antrean
     *
     * Data antrean petugas.
     */
    public function index()
    {
        return $this->jalankan(fn () =>
            $this->pelayananService->getAntreanPetugas(
                $this->petugasId()
            )
        );
    }

    /**
     * GET /petugas/antrean/status-audio
     *
     * Memeriksa kesiapan seluruh Display dan status
     * jalur suara Kelompok milik petugas.
     */
    public function statusAudio()
    {
        return $this->jalankan(function () {
            $petugasId = $this->petugasId();

            $db = db_connect();

            /*
             * Cari Kelompok suara milik petugas.
             */
            $petugas = $db->table('users u')
                ->select([
                    'u.id',
                    'u.instansi_id',
                    'i.nama_instansi',
                    'g.kelompok_id',
                ])
                ->join(
                    'instansi i',
                    'i.id = u.instansi_id'
                )
                ->join(
                    'grup g',
                    'g.id = i.grup_id'
                )
                ->where('u.id', $petugasId)
                ->where('u.role_id', 2)
                ->get()
                ->getRowArray();

            if (!$petugas) {
                throw new RuntimeException(
                    'Data instansi atau Kelompok petugas tidak ditemukan.'
                );
            }

            $kelompokId = (int) $petugas['kelompok_id'];

            /*
             * Ambil status seluruh Display.
             */
            $kelompok = $db->table('kelompok')
                ->select([
                    'id',
                    'nama_kelompok',
                    'display_heartbeat_at',
                    'display_audio_ready',
                    'status_panggilan',
                ])
                ->orderBy('nama_kelompok', 'ASC')
                ->get()
                ->getResultArray();

            if (empty($kelompok)) {
                throw new RuntimeException(
                    'Tidak ada Kelompok yang terdaftar.'
                );
            }

            $sekarang = time();
            $semuaSiap = true;
            $statusAudioPetugas = 'IDLE';
            $daftarDisplay = [];

            foreach ($kelompok as $item) {
                $heartbeat = !empty(
                    $item['display_heartbeat_at']
                )
                    ? strtotime(
                        (string) $item['display_heartbeat_at']
                    )
                    : false;

                $selisih = $heartbeat !== false
                    ? $sekarang - $heartbeat
                    : PHP_INT_MAX;

                $online = (
                    $heartbeat !== false
                    && $selisih >= 0
                    && $selisih <= 15
                );

                $audioReady = (
                    $online
                    && (int) $item['display_audio_ready'] === 1
                );

                if (!$online) {
                    $status = 'OFFLINE';
                } elseif (!$audioReady) {
                    $status = 'BELUM_SIAP';
                } else {
                    $status = 'SIAP';
                }

                if (!$audioReady) {
                    $semuaSiap = false;
                }

                $statusPanggilan = (
                    $item['status_panggilan'] === 'PLAYING'
                )
                    ? 'PLAYING'
                    : 'IDLE';

                if ((int) $item['id'] === $kelompokId) {
                    $statusAudioPetugas = $statusPanggilan;
                }

                $daftarDisplay[] = [
                    'id' => (int) $item['id'],
                    'nama_kelompok' => $item['nama_kelompok'],
                    'online' => $online,
                    'audio_ready' => $audioReady,
                    'ready' => $audioReady,
                    'status' => $status,
                ];
            }

            return [
                'semua_display_siap' => $semuaSiap,
                'status_panggilan' => $statusAudioPetugas,
                'kelompok_id' => $kelompokId,
                'instansi_id' => (int) $petugas['instansi_id'],
                'nama_instansi' => $petugas['nama_instansi'],
                'displays' => $daftarDisplay,
            ];
        });
    }

    /**
     * POST /petugas/antrean/panggil
     *
     * Panggil antrean pertama.
     */
    public function panggil()
    {
        return $this->jalankan(function () {
            $petugasId = $this->petugasId();
            $input = $this->input();

            return $this->pelayananService->panggilAntrean(
                $petugasId,
                $this->angka($input, 'instansi_id')
            );
        });
    }

    /**
     * POST /petugas/antrean/panggil-ulang
     *
     * Panggil ulang antrean.
     */
    public function panggilUlang()
    {
        return $this->jalankan(function () {
            $petugasId = $this->petugasId();
            $input = $this->input();

            return $this->pelayananService->panggilUlang(
                $petugasId,
                $this->angka($input, 'riwayat_layanan_id')
            );
        });
    }

    /**
     * POST /petugas/antrean/status
     *
     * Konfirmasi status layanan.
     */
    public function konfirmasiStatus()
    {
        return $this->jalankan(function () {
            $petugasId = $this->petugasId();
            $input = $this->input();

            $status = strtoupper(
                trim((string) ($input['status'] ?? ''))
            );

            if (!in_array($status, ['SELESAI', 'PENDING'], true)) {
                throw new RuntimeException(
                    'Status harus SELESAI atau PENDING.'
                );
            }

            $layananId = $status === 'SELESAI'
                ? $this->angka($input, 'layanan_id')
                : null;

            return $this->pelayananService->konfirmasiStatus(
                $petugasId,
                $this->angka($input, 'riwayat_layanan_id'),
                $status,
                $layananId,
                trim((string) ($input['keterangan'] ?? ''))
            );
        });
    }

    /**
     * POST /petugas/antrean/panggil-pending
     *
     * Panggil kembali antrean Pending.
     */
    public function panggilPending()
    {
        return $this->jalankan(function () {
            $petugasId = $this->petugasId();
            $input = $this->input();

            return $this->pelayananService->panggilPending(
                $petugasId,
                $this->angka($input, 'riwayat_layanan_id')
            );
        });
    }

    /**
     * POST /petugas/antrean/terusan
     *
     * Terusan antrean.
     */
    public function terusan()
    {
        return $this->jalankan(function () {
            $petugasId = $this->petugasId();
            $input = $this->input();

            return $this->pelayananService->terusanAntrean(
                $petugasId,
                $this->angka($input, 'riwayat_layanan_id'),
                $this->angka($input, 'layanan_id'),
                $this->angka($input, 'instansi_tujuan_id'),
                trim((string) ($input['keterangan'] ?? ''))
            );
        });
    }
}