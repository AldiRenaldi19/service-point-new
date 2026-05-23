<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

abstract class Controller
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL API / AJAX RESPONSE HELPERS (CLEAN CODE)
    |--------------------------------------------------------------------------
    | Kumpulan metode pembantu terpusat untuk mengembalikan respon JSON yang seragam.
    | Ini memastikan format error atau sukses aplikasi selalu konsisten dan aman.
    |
    */

    /**
     * Respon Sukses Standar Terpusat
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function sendResponse(mixed $data, string $message = 'Operasi berhasil.', int $code = 200): JsonResponse
    {
        return Response::json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * Respon Error Standar Terpusat (Anti-Information Leakage)
     * * Hacker Protection: Mencegah aplikasi menampilkan stack trace internal/SQL error 
     * ke pengguna luar yang bisa dipakai untuk memetakan kelemahan sistem.
     *
     * @param string $error
     * @param array<mixed> $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    protected function sendError(string $error, array $errorMessages = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (! empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return Response::json($response, code: $code);
    }
}
