@extends('backoffice.layouts.app')
@section('title', 'Ganti Password')
@section('page-title', 'Ganti Password')

@section('content')
<div class="bo-card" style="max-width:560px;">
    @if(session('success'))
        <div style="padding:12px 14px;margin-bottom:18px;border-radius:10px;background:#dcfce7;color:#166534;">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div style="padding:12px 14px;margin-bottom:18px;border-radius:10px;background:#fee2e2;color:#991b1b;">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="/backoffice/password">
        @csrf
        <div class="form-group">
            <label class="bo-label" for="current_password">Password Saat Ini</label>
            <input class="bo-input" type="password" id="current_password" name="current_password" required autocomplete="current-password">
        </div>
        <div class="form-group">
            <label class="bo-label" for="password">Password Baru</label>
            <input class="bo-input" type="password" id="password" name="password" required minlength="8" autocomplete="new-password">
        </div>
        <div class="form-group">
            <label class="bo-label" for="password_confirmation">Ulangi Password Baru</label>
            <input class="bo-input" type="password" id="password_confirmation" name="password_confirmation" required minlength="8" autocomplete="new-password">
        </div>
        <button class="btn-primary" type="submit">Simpan Password</button>
    </form>
</div>
@endsection
