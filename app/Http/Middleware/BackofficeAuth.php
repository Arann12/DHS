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

        // Periodic session regeneration (every 30 mins)
        $lastRegen = session('backoffice_auth_regen', 0);
        if (time() - $lastRegen > 1800) {
            session()->regenerate();
            session(['backoffice_auth_regen' => time()]);
        }

        return $next($request);
    }
}
