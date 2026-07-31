<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BackofficeAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated via session
        if (!session('backoffice_user')) {
            // If AJAX request, return 401
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            // Otherwise redirect to login
            return redirect('/backoffice')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Re-fetch user from DB to detect deactivated accounts
        $sessionUser = session('backoffice_user');
        $dbUser = \App\Models\User::find($sessionUser['id'] ?? 0);
        if (!$dbUser || !$dbUser->is_active) {
            session()->forget('backoffice_user');
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Akun tidak aktif.'], 401);
            }
            return redirect('/backoffice')->with('error', 'Akun Anda telah dinonaktifkan.');
        }

        // Role-based authorization for sensitive routes
        $sensitivePaths = ['backoffice/users', 'backoffice/branding'];
        $requiresAdmin = collect($sensitivePaths)->contains(fn($p) => str_starts_with($request->path(), $p));
        $userRole = $sessionUser['role'] ?? '';
        if ($requiresAdmin && !in_array($userRole, ['super_admin', 'admin'])) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
            return redirect('/backoffice/dashboard')->with('error', 'Akses ditolak.');
        }

        // Periodic session regeneration (every 30 mins)
        $lastRegen = session('backoffice_auth_regen', 0);
        if (time() - $lastRegen > 1800) {
            session()->regenerate();
            session(['backoffice_auth_regen' => time()]);
        }

        return $next($request);
    }
}
