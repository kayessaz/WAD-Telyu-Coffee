<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika permintaan membutuhkan JSON, biarkan null untuk menghindari redireksi
        if ($request->expectsJson()) {
            return null;
        }

        // Simpan pesan flash untuk memberi tahu pengguna bahwa mereka perlu login
        session()->flash('error', 'You must log in to access this page.');

        // Arahkan ke halaman login
        return route('login');
    }
}
