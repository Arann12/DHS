<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang-kami', function () {
    return view('tentang');
});

Route::get('/akademi', function () {
    return view('akademi');
});

Route::get('/berita', function () {
    return view('berita');
});

Route::get('/faq', function () {
    return view('faq');     
});

Route::get('/karier', function () {
    return view('karier');
});

// Placeholders for routes in the nav/footer that might be clicked
Route::get('/formulir-pendaftaran', function () {
    return view('registration');
});

Route::get('/cara-mendaftar', function () {
    return view('registration');
});

Route::post('/pendaftaran', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'nama_lengkap'       => 'required|string|max:255',
        'hp_wa'              => 'required|string|max:50',
        'email'              => 'required|email|max:255',
        'kategori'           => 'required|string',
        'program'            => 'required|string',
        'special_request'    => 'nullable|string',
        'bukti_pendaftaran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'bukti_program'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'sumber_info'        => 'nullable|array',
    ]);

    // Save uploaded files if present
    $buktiPendaftaranName = null;
    if ($request->hasFile('bukti_pendaftaran')) {
        $file = $request->file('bukti_pendaftaran');
        $buktiPendaftaranName = time() . '_pendaftaran_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti'), $buktiPendaftaranName);
    }

    $buktiProgramName = null;
    if ($request->hasFile('bukti_program')) {
        $file = $request->file('bukti_program');
        $buktiProgramName = time() . '_program_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti'), $buktiProgramName);
    }

    // Save entry into session array (mock database storage for frontend-only scope)
    $pendaftarBaru = [
        'id'                 => time(),
        'tgl'                => date('d M Y H:i'),
        'nama'               => $validated['nama_lengkap'],
        'hp'                 => $validated['hp_wa'],
        'email'              => $validated['email'],
        'kategori'           => $validated['kategori'],
        'program'            => $validated['program'],
        'special_request'    => $validated['special_request'] ?? '',
        'sumber'             => implode(', ', $request->input('sumber_info', [])),
        'bukti_pendaftaran'  => $buktiPendaftaranName,
        'bukti_program'      => $buktiProgramName,
        'status'             => 'Baru',
    ];

    $allPendaftar = session('list_pendaftar', []);
    array_unshift($allPendaftar, $pendaftarBaru);
    session(['list_pendaftar' => $allPendaftar]);

    return back()->with('reg_success', 'Terima kasih ' . $validated['nama_lengkap'] . '! Pendaftaran Anda telah kami terima. Tim admisi DHS akan menghubungi WhatsApp Anda dalam 1x24 jam.');
});

// ============================================================
//  BACKOFFICE ROUTES (Frontend-only, mock auth via session)
// ============================================================

// Login page
Route::get('/backoffice', function () {
    // If already "logged in" (mock session), go to dashboard
    if (session('backoffice_user')) {
        return redirect('/backoffice/dashboard');
    }
    return view('backoffice.auth.login');
});

// Mock login handler
Route::post('/backoffice/login', function (\Illuminate\Http\Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Mock credentials — replace with real auth later
    if ($username === 'admin' && $password === 'admin123') {
        session(['backoffice_user' => ['name' => 'Administrator', 'username' => 'admin', 'role' => 'Super Admin']]);
        return redirect('/backoffice/dashboard');
    }

    return back()->withErrors(['auth' => 'Username atau password salah.'])->withInput();
});

// Logout
Route::get('/backoffice/logout', function () {
    session()->forget('backoffice_user');
    return redirect('/backoffice');
});

// Protected backoffice pages — middleware-like check via closure
$backofficePages = [
    'dashboard'  => 'backoffice.dashboard',
    'branding'   => 'backoffice.branding',
    'beranda'    => 'backoffice.beranda',
    'statistik'  => 'backoffice.statistik',
    'program'    => 'backoffice.program',
    'berita'     => 'backoffice.berita',
    'galeri'     => 'backoffice.galeri',
    'testimoni'  => 'backoffice.testimoni',
    'faq'        => 'backoffice.faq',
    'admisi'     => 'backoffice.admisi',
    'pendaftar'  => 'backoffice.pendaftar',
    'navigasi'   => 'backoffice.navigasi',
    'footer-cms' => 'backoffice.footer',
    'users'      => 'backoffice.users',
];

foreach ($backofficePages as $path => $view) {
    Route::get('/backoffice/' . $path, function () use ($view) {
        if (!session('backoffice_user')) {
            return redirect('/backoffice');
        }
        return view($view, ['user' => session('backoffice_user')]);
    });
}

