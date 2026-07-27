<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackofficeController;

/*
|--------------------------------------------------------------------------
| FRONTEND PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/',                function () { return app(FrontendController::class)->welcome(); });
Route::get('/tentang-kami',    function () { return app(FrontendController::class)->tentang(); });
Route::get('/tentang',         function () { return app(FrontendController::class)->tentang(); });
Route::get('/akademi',         function () { return app(FrontendController::class)->akademi(); });
Route::get('/berita',          function () { return app(FrontendController::class)->berita(request()); });
Route::get('/faq',             function () { return app(FrontendController::class)->faq(); });
Route::get('/karier',          function () { return app(FrontendController::class)->karier(); });
Route::get('/cara-mendaftar',  function () { return app(FrontendController::class)->registration(); });
Route::get('/formulir-pendaftaran', function () { return app(FrontendController::class)->registration(); });

Route::post('/pendaftaran', [FrontendController::class, 'submitRegistration']);

/*
|--------------------------------------------------------------------------
| BACKOFFICE AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/backoffice',         [AuthController::class, 'showLogin']);
Route::post('/backoffice/login',  [AuthController::class, 'login']);
Route::get('/backoffice/logout',  [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| BACKOFFICE PAGES (GET)
|--------------------------------------------------------------------------
*/
Route::get('/backoffice/dashboard',     [BackofficeController::class, 'dashboard']);
Route::get('/backoffice/beranda',       [BackofficeController::class, 'beranda']);
Route::get('/backoffice/branding',      [BackofficeController::class, 'branding']);
Route::get('/backoffice/color-palette', [BackofficeController::class, 'colorPalette']);
Route::get('/backoffice/statistik',     [BackofficeController::class, 'statistik']);
Route::get('/backoffice/program',       [BackofficeController::class, 'program']);
Route::get('/backoffice/berita',        [BackofficeController::class, 'berita']);
Route::get('/backoffice/galeri',        [BackofficeController::class, 'galeri']);
Route::get('/backoffice/testimoni',     [BackofficeController::class, 'testimoni']);
Route::get('/backoffice/faq',           [BackofficeController::class, 'faq']);
Route::get('/backoffice/admisi',        [BackofficeController::class, 'admisi']);
Route::get('/backoffice/pendaftar',     [BackofficeController::class, 'pendaftar']);
Route::get('/backoffice/navigasi',      [BackofficeController::class, 'navigasi']);
Route::get('/backoffice/footer-cms',    [BackofficeController::class, 'footer']);
Route::get('/backoffice/users',         [BackofficeController::class, 'users']);

/*
|--------------------------------------------------------------------------
| BACKOFFICE CRUD ENDPOINTS (POST/PUT/DELETE)
|--------------------------------------------------------------------------
*/
// Beranda CMS
Route::post('/backoffice/beranda/update',       [BackofficeController::class, 'berandaUpdate']);

// Branding
Route::post('/backoffice/branding/update',      [BackofficeController::class, 'brandingUpdate']);

// Color Palette
Route::post('/backoffice/color-palette/update', [BackofficeController::class, 'colorPaletteUpdate']);

// Statistik
Route::post('/backoffice/statistik/store',      [BackofficeController::class, 'statistikStore']);
Route::post('/backoffice/statistik/{id}/update',[BackofficeController::class, 'statistikUpdate']);
Route::post('/backoffice/statistik/{id}/delete',[BackofficeController::class, 'statistikDestroy']);

// Program
Route::post('/backoffice/program/store',        [BackofficeController::class, 'programStore']);
Route::post('/backoffice/program/{id}/update',  [BackofficeController::class, 'programUpdate']);
Route::post('/backoffice/program/{id}/delete',  [BackofficeController::class, 'programDestroy']);

// Berita
Route::post('/backoffice/berita/store',         [BackofficeController::class, 'beritaStore']);
Route::post('/backoffice/berita/{id}/update',   [BackofficeController::class, 'beritaUpdate']);
Route::post('/backoffice/berita/{id}/delete',   [BackofficeController::class, 'beritaDestroy']);

// Galeri
Route::post('/backoffice/galeri/store',         [BackofficeController::class, 'galeriStore']);
Route::post('/backoffice/galeri/{id}/update',   [BackofficeController::class, 'galeriUpdate']);
Route::post('/backoffice/galeri/{id}/delete',   [BackofficeController::class, 'galeriDestroy']);

// Testimoni
Route::post('/backoffice/testimoni/store',         [BackofficeController::class, 'testimoniStore']);
Route::post('/backoffice/testimoni/{id}/update',   [BackofficeController::class, 'testimoniUpdate']);
Route::post('/backoffice/testimoni/{id}/delete',   [BackofficeController::class, 'testimoniDestroy']);

// FAQ
Route::post('/backoffice/faq/store',            [BackofficeController::class, 'faqStore']);
Route::post('/backoffice/faq/{id}/update',      [BackofficeController::class, 'faqUpdate']);
Route::post('/backoffice/faq/{id}/delete',      [BackofficeController::class, 'faqDestroy']);

// Admisi
Route::post('/backoffice/admisi/update-helpdesk', [BackofficeController::class, 'updateHelpdesk']);
Route::post('/backoffice/admisi/{id}/update',   [BackofficeController::class, 'admisiUpdate']);

// Pendaftar
Route::get('/backoffice/pendaftar/export',        [BackofficeController::class, 'pendaftarExportExcel']);
Route::post('/backoffice/pendaftar/update-status', [BackofficeController::class, 'pendaftarUpdateStatus']);
Route::post('/backoffice/pendaftar/delete',        [BackofficeController::class, 'pendaftarDestroy']);

// Navigasi
Route::post('/backoffice/navigasi/store',        [BackofficeController::class, 'navigasiStore']);
Route::post('/backoffice/navigasi/{id}/update',  [BackofficeController::class, 'navigasiUpdate']);
Route::post('/backoffice/navigasi/{id}/delete',  [BackofficeController::class, 'navigasiDestroy']);

// Footer CMS
Route::post('/backoffice/footer-cms/update',    [BackofficeController::class, 'footerUpdate']);

// Users
Route::post('/backoffice/users/store',          [BackofficeController::class, 'usersStore']);
Route::post('/backoffice/users/{id}/update',    [BackofficeController::class, 'usersUpdate']);
Route::post('/backoffice/users/{id}/delete',    [BackofficeController::class, 'usersDestroy']);
