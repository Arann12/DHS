<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('backoffice_user')) {
            return redirect('/backoffice/dashboard');
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

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['auth' => 'Username atau password salah.'])->withInput();
        }

        // Update last login
        $user->update(['last_login_at' => now()]);

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

        return redirect('/backoffice/dashboard');
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
