<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if ($session->get('is_logged_in')) {
            return;
        }

        $accept = $request->getHeaderLine('Accept');

        // Request API: tetap balas JSON
        if (str_contains($accept, 'application/json')) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Anda belum login.',
                ]);
        }

        // Request halaman web: arahkan ke halaman login
        return redirect()->to(site_url('/'));
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak ada tindakan setelah request.
    }
}