<?php

namespace App\Controllers;

use App\Models\KelompokModel;
use App\Models\GrupModel;
use App\Models\InstansiModel;
use App\Services\DisplayService;
use CodeIgniter\Exceptions\PageNotFoundException;
use Throwable;

class DisplayController extends BaseController
{
    protected KelompokModel $kelompokModel;
    protected GrupModel $grupModel;
    protected InstansiModel $instansiModel;
    protected DisplayService $displayService;

    public function __construct()
    {
        $this->kelompokModel = new KelompokModel();
        $this->grupModel = new GrupModel();
        $this->instansiModel = new InstansiModel();
        $this->displayService = new DisplayService();
    }

    /**
     * GET /display
     */
    public function index()
    {
        $kelompok = $this->kelompokModel
            ->orderBy('nama_kelompok', 'ASC')
            ->findAll();

        $grup = $this->grupModel
            ->orderBy('nama_grup', 'ASC')
            ->findAll();

        $instansi = $this->instansiModel
            ->select('grup_id, nama_instansi')
            ->orderBy('nama_instansi', 'ASC')
            ->findAll();

        $instansiPerGrup = [];

        foreach ($instansi as $item) {
            $grupId = (int) $item['grup_id'];

            if (!isset($instansiPerGrup[$grupId])) {
                $instansiPerGrup[$grupId] = [];
            }

            $instansiPerGrup[$grupId][] =
                $item['nama_instansi'];
        }

        foreach ($grup as &$item) {
            $grupId = (int) $item['id'];

            $item['daftar_instansi'] =
                $instansiPerGrup[$grupId] ?? [];
        }

        unset($item);

        return view('display/pilih_kelompok', [
            'kelompok' => $kelompok,
            'grup'     => $grup,
        ]);
    }

    /**
     * GET /display/layar/{kelompokId}/{grupId}
     *
     * Membuka layar Display sekaligus membuat
     * session token baru untuk perangkat Display.
     */
 public function layar($kelompokId, $grupId)
{
    $kelompokId = (int) $kelompokId;
    $grupId = (int) $grupId;

    if ($kelompokId < 1 || $grupId < 1) {
        throw PageNotFoundException::forPageNotFound(
            'Kelompok atau Grup tidak valid.'
        );
    }

    // Token pemilik tab dikirim dari halaman Pilih Display.
    $displaySessionToken = (string) $this->request->getGet(
        'owner_token'
    );

    if (!preg_match('/^[a-f0-9]{64}$/', $displaySessionToken)) {
        return $this->response
            ->setStatusCode(400)
            ->setBody(
                'Token Display tidak valid. Silakan buka dari halaman Pilih Display.'
            );
    }

    $db = null;
    $transactionStarted = false;

    try {
        $data = $this->displayService
            ->getDisplayByKelompokDanGrup(
                $kelompokId,
                $grupId
            );

        $db = db_connect();

        // Mulai transaksi untuk menghindari klaim bersamaan.
        $db->transBegin();
        $transactionStarted = true;

        $kelompok = $db->query(
            'SELECT
                id,
                display_session_token,
                display_heartbeat_at
             FROM kelompok
             WHERE id = ?
             FOR UPDATE',
            [$kelompokId]
        )->getRowArray();

        if (!$kelompok) {
            $db->transRollback();
            $transactionStarted = false;

            return $this->response
                ->setStatusCode(404)
                ->setBody('Kelompok tidak ditemukan.');
        }

        $heartbeatAt = !empty($kelompok['display_heartbeat_at'])
            ? strtotime($kelompok['display_heartbeat_at'])
            : false;

        $umurHeartbeat = $heartbeatAt !== false
            ? time() - $heartbeatAt
            : -1;

        // Display dianggap aktif jika heartbeat maksimal 15 detik.
        $displayMasihAktif = (
            $heartbeatAt !== false
            && $umurHeartbeat >= 0
            && $umurHeartbeat <= 15
        );

        $tokenLama = (string) (
            $kelompok['display_session_token'] ?? ''
        );

        // Tolak jika Kelompok masih digunakan tab/perangkat lain.
        if (
            $displayMasihAktif
            && (
                $tokenLama === ''
                || !hash_equals(
                    $tokenLama,
                    $displaySessionToken
                )
            )
        ) {
            $db->transRollback();
            $transactionStarted = false;

            return $this->response
                ->setStatusCode(409)
                ->setBody(
                    'Display untuk Kelompok ini sedang aktif di perangkat atau tab lain. Tutup Display tersebut terlebih dahulu.'
                );
        }

        // Token sama berarti tab yang sama sedang melakukan refresh.
        // Token berbeda hanya boleh mengambil alih jika heartbeat lama kedaluwarsa.
        $db->table('kelompok')
            ->where('id', $kelompokId)
            ->update([
                'display_session_token' => $displaySessionToken,
                'display_heartbeat_at'  => date('Y-m-d H:i:s'),
                'display_audio_ready'   => 0,
            ]);

        if ($db->transStatus() === false) {
            throw new \RuntimeException(
                'Gagal mengunci slot Display.'
            );
        }

        $db->transCommit();
        $transactionStarted = false;

        return view('display/index', [
            'kelompokId' => $kelompokId,
            'grupId'     => $grupId,

            'kelompok' =>
                $data['kelompok']['nama_kelompok'],

            'grupAktif' => $data['grup_aktif'],
            'grup'      => $data['grup'],
            'instansi'  => $data['instansi'],
            'antrean'   => $data['antrean'],
            'ringkasan' => $data['ringkasan'],

            'initialData' => $data,

            'displaySessionToken' => $displaySessionToken,
        ]);

    } catch (Throwable $e) {
        if ($transactionStarted && $db !== null) {
            $db->transRollback();
        }

        log_message(
            'error',
            'Gagal membuka Display: ' . $e->getMessage()
        );

        return $this->response
            ->setStatusCode(500)
            ->setBody(
                'Display gagal dibuka. Silakan periksa log aplikasi.'
            );
    }
}
    /**
     * GET /display/kelompok/{kelompokId}/grup/{grupId}
     *
     * API polling data Display.
     */
    public function kelompok($kelompokId, $grupId)
    {
        $kelompokId = (int) $kelompokId;
        $grupId = (int) $grupId;

        if ($kelompokId < 1 || $grupId < 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok atau Grup tidak valid.',
                ]);
        }

        try {
            $data = $this->displayService
                ->getDisplayByKelompokDanGrup(
                    $kelompokId,
                    $grupId
                );

            return $this->response->setJSON([
                'status' => true,
                'data'   => $data,
            ]);

        } catch (Throwable $e) {
            log_message(
                'error',
                'Gagal mengambil data Display: ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal mengambil data Display.',
                ]);
        }
    }

    /**
     * POST /display/heartbeat/{kelompokId}
     *
     * Display mengirim heartbeat secara berkala.
     *
     * JSON:
     * {
     *   "session_token": "...",
     *   "audio_ready": 1
     * }
     */
    public function heartbeat($kelompokId)
    {
        $kelompokId = (int) $kelompokId;

        if ($kelompokId < 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok tidak valid.',
                ]);
        }

        $input = $this->request->getJSON(true);

        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Request JSON tidak valid.',
                ]);
        }

        $sessionToken = (string) ($input['session_token'] ?? '');

        if ($sessionToken === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Session token wajib dikirim.',
                ]);
        }

        $audioReady = (int) ($input['audio_ready'] ?? 0);
        $audioReady = $audioReady === 1 ? 1 : 0;

        try {
            $db = db_connect();

            $kelompok = $db->table('kelompok')
                ->select('id, display_session_token')
                ->where('id', $kelompokId)
                ->get()
                ->getRowArray();

            if (!$kelompok) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Kelompok tidak ditemukan.',
                    ]);
            }

            if (
                empty($kelompok['display_session_token'])
                || !hash_equals(
                    (string) $kelompok['display_session_token'],
                    $sessionToken
                )
            ) {
                return $this->response
                    ->setStatusCode(403)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Session Display sudah tidak berlaku.',
                    ]);
            }

            $db->table('kelompok')
                ->where('id', $kelompokId)
                ->where('display_session_token', $sessionToken)
                ->update([
                    'display_heartbeat_at' => date('Y-m-d H:i:s'),
                    'display_audio_ready'  => $audioReady,
                ]);

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Heartbeat berhasil.',
            ]);

        } catch (Throwable $e) {
            log_message(
                'error',
                'Heartbeat Display gagal: ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal memperbarui heartbeat.',
                ]);
        }
    }

    /**
     * GET /display/status-kelompok
     *
     * Mengambil status seluruh Display.
     *
     * Status:
     * - OFFLINE
     * - BELUM_SIAP
     * - SIAP
     */
    public function statusKelompok()
    {
        try {
            $db = db_connect();

            $kelompok = $db->table('kelompok')
                ->select([
                    'id',
                    'nama_kelompok',
                    'display_heartbeat_at',
                    'display_audio_ready',
                ])
                ->orderBy('nama_kelompok', 'ASC')
                ->get()
                ->getResultArray();

            $sekarang = time();
            $hasil = [];

            foreach ($kelompok as $item) {
                $heartbeatAt = !empty($item['display_heartbeat_at'])
                    ? strtotime($item['display_heartbeat_at'])
                    : false;

                $umurHeartbeat = $heartbeatAt !== false
                    ? $sekarang - $heartbeatAt
                    : -1;

                $online = (
                    $heartbeatAt !== false
                    && $umurHeartbeat >= 0
                    && $umurHeartbeat <= 15
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

                $hasil[] = [
                    'id'            => (int) $item['id'],
                    'nama_kelompok' => $item['nama_kelompok'],
                    'online'        => $online,
                    'audio_ready'   => $audioReady,
                    'ready'         => $online && $audioReady,
                    'status'        => $status,
                ];
            }

            return $this->response->setJSON([
                'status' => true,
                'data'   => $hasil,
            ]);

        } catch (Throwable $e) {
            log_message(
                'error',
                'Gagal mengambil status Display: ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal mengambil status Kelompok.',
                ]);
        }
    }

    /**
     * POST /display/audio-selesai/{kelompokId}
     *
     * Dipanggil setelah satu rangkaian audio selesai.
     *
     * JSON:
     * {
     *   "session_token": "...",
     *   "riwayat_panggilan_id": 123
     * }
     *
     * Melepas kunci suara Kelompok.
     */
    public function audioSelesai($kelompokId)
    {
        $kelompokId = (int) $kelompokId;

        if ($kelompokId < 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Kelompok tidak valid.',
                ]);
        }

        $input = $this->request->getJSON(true);

        if (!is_array($input)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Request JSON tidak valid.',
                ]);
        }

        $sessionToken = (string) ($input['session_token'] ?? '');

        $riwayatId = filter_var(
            $input['riwayat_panggilan_id'] ?? null,
            FILTER_VALIDATE_INT
        );

        if (
            $sessionToken === ''
            || $riwayatId === false
            || $riwayatId < 1
        ) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Data penyelesaian audio tidak valid.',
                ]);
        }

        $db = db_connect();

        try {
            $db->transBegin();

            // Kunci baris Kelompok agar tidak terjadi race condition.
            $kelompok = $db->query(
                'SELECT
                    id,
                    status_panggilan,
                    riwayat_panggilan_aktif_id,
                    display_session_token
                 FROM kelompok
                 WHERE id = ?
                 FOR UPDATE',
                [$kelompokId]
            )->getRowArray();

            if (!$kelompok) {
                $db->transRollback();

                return $this->response
                    ->setStatusCode(404)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Kelompok tidak ditemukan.',
                    ]);
            }

            // Pastikan token Display masih berlaku.
            if (
                empty($kelompok['display_session_token'])
                || !hash_equals(
                    (string) $kelompok['display_session_token'],
                    $sessionToken
                )
            ) {
                $db->transRollback();

                return $this->response
                    ->setStatusCode(403)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Session Display sudah tidak berlaku.',
                    ]);
            }

            // Pastikan panggilan yang selesai adalah panggilan aktif.
            if (
                $kelompok['status_panggilan'] !== 'PLAYING'
                || (int) $kelompok['riwayat_panggilan_aktif_id']
                    !== (int) $riwayatId
            ) {
                $db->transRollback();

                return $this->response
                    ->setStatusCode(409)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Panggilan aktif tidak cocok.',
                    ]);
            }

            // Lepaskan kunci hanya setelah audio selesai.
            $db->table('kelompok')
                ->where('id', $kelompokId)
                ->update([
                    'status_panggilan'           => 'IDLE',
                    'riwayat_panggilan_aktif_id' => null,
                    'token_panggilan'            => null,
                    'batas_kunci'                => null,
                ]);

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'Gagal melepas kunci suara.'
                );
            }

            $db->transCommit();

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Audio selesai. Kunci suara dilepas.',
            ]);

        } catch (Throwable $e) {
            $db->transRollback();

            log_message(
                'error',
                'Gagal menyelesaikan audio Display: ' . $e->getMessage()
            );

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Gagal menyelesaikan audio.',
                ]);
        }
    }
}