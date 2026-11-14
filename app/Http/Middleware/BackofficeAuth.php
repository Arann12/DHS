<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BackofficeAuth
{
    private const FINANCE_PREFIXES = [
        'backoffice/kas',
        'backoffice/kas-keuangan-program',
        'backoffice/kas-kategori',
        'backoffice/kas-program',
        'backoffice/kas-jenis-program',
        'backoffice/kas-proyek',
        'backoffice/program-kategori',
    ];

    public static function roleAllowsPath(string $role, string $path): bool
    {
        // Users management is restricted strictly to super_admin
        if (str_starts_with($path, 'backoffice/users')) {
            return $role === 'super_admin';
        }

        $isFinancePath = collect(self::FINANCE_PREFIXES)
            ->contains(fn (string $prefix) => str_starts_with($path, $prefix));
        $isPasswordPath = str_starts_with($path, 'backoffice/password');

        return match ($role) {
            'super_admin' => true,
            'finance' => $isFinancePath || $isPasswordPath || $path === 'backoffice/',
            'admin' => !$isFinancePath,
            default => false,
        };
    }

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

        // Role-based authorization for all backoffice routes.
        $userRole = $dbUser->role;
        if (!self::roleAllowsPath($userRole, $request->path())) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
            $fallback = $userRole === 'finance' ? '/backoffice/kas' : '/backoffice/dashboard';
            return redirect($fallback)->with('error', 'Akses ditolak.');
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
