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
Route::get('/cara-mendaftar', function () {
    return redirect('/faq#pendaftaran');
});

Route::get('/beasiswa', function () {
    return redirect('/faq#pendaftaran');
});

Route::get('/biaya', function () {
    return redirect('/faq#biaya');
});

Route::get('/privacy-policy', function () {
    return redirect('/faq');
});

Route::get('/legal', function () {
    return redirect('/faq');
});

Route::get('/cookies', function () {
    return redirect('/faq');
});

