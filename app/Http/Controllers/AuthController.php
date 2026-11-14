<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public const DUMMY_PASSWORD_HASH = '$2y$10$KlNR.Gdhj.zPRH/XavjAUOhs8TdVyO/PUWDdLeUPGPTrDzR06zQYC';

    public function showLogin()
    {
        if (session('backoffice_user')) {
            return redirect((session('backoffice_user.role') ?? '') === 'finance' ? '/backoffice/kas' : '/backoffice/dashboard');
        }
        return view('backoffice.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check by username field
        $user = User::where('username', $request->username)->where('is_active', 1)->first();

        // Timing-safe: always run Hash::check even if user not found.
        $passwordValid = $user
            ? Hash::check($request->password, $user->password)
            : Hash::check($request->password, self::DUMMY_PASSWORD_HASH);

        if (!$user || !$passwordValid) {
            return back()->withErrors(['auth' => 'Username atau password salah.'])->withInput();
        }

        // Update last login
        $user->update(['last_login_at' => now()]);

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        // Log login activity
        ActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'login',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);

        session([
            'backoffice_user' => [
                'id'       => $user->id,
                'name'     => $user->name,
                'username' => $user->username,
                'email'    => $user->email,
                'role'     => $user->role,
            ]
        ]);

        return redirect($user->role === 'finance' ? '/backoffice/kas' : '/backoffice/dashboard');
    }

    public function logout()
    {
        $u = session('backoffice_user');
        if ($u) {
            ActivityLog::create([
                'user_id'    => $u['id'],
                'action'     => 'logout',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'created_at' => now(),
            ]);
        }
        session()->forget('backoffice_user');
        return redirect('/backoffice');
    }
}
