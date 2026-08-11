<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — DHS Backoffice</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bo-blue:      #1A365D;
            --bo-dark-blue: #0F2440;
            --bo-red:       #C53030;
            --bo-cream:     #F7FAFC;
            --bo-beige:     #EBF4FF;
        }
        /* Hide x-cloak elements only after Alpine loads */
        [x-cloak] { display: none !important; }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bo-cream);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        /* decorative background shapes */
        body::before {
            content: '';
            position: fixed;
            top: -200px; right: -200px;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(197,48,48,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -200px; left: -200px;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(197,48,48,0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        /* DHS Badge at top */
        .dhs-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 28px;
        }

        .dhs-logo-mark {
            width: 64px; height: 64px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--bo-blue) 0%, var(--bo-dark-blue) 100%);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 12px 32px rgba(197,48,48,0.25);
            margin-bottom: 14px;
        }

        .dhs-logo-mark svg {
            width: 36px; height: 36px;
            fill: none;
        }

        .dhs-wordmark {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--bo-dark-blue);
            text-align: center;
            margin: 0;
        }

        .dhs-subtitle {
            font-size: 12.5px;
            color: #718096;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-top: 4px;
            font-weight: 500;
        }

        /* Login Card */
        .login-card {
            background: #fff;
            border-radius: 24px;
            padding: 36px;
            box-shadow: 0 8px 48px rgba(0,0,0,0.09), 0 2px 8px rgba(0,0,0,0.04);
        }

        .login-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: var(--bo-dark-blue);
            margin: 0 0 6px;
        }

        .login-card p {
            font-size: 13.5px;
            color: #718096;
            margin: 0 0 28px;
        }

        /* Error alert */
        .error-alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: rgba(197,48,48,0.07);
            border: 1.5px solid rgba(197,48,48,0.25);
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 20px;
            color: #c00;
            font-size: 13.5px;
            font-weight: 500;
        }

        /* Form */
        .form-group { margin-bottom: 18px; }
        label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #444;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .input-icon {
            position: absolute;
            left: 13px; top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 18px;
            pointer-events: none;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 11px 14px 11px 44px;
            border: 1.5px solid #e0e0e0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1A365D;
            background: #fff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: var(--bo-blue);
            box-shadow: 0 0 0 3px rgba(26,54,93,0.12);
        }

        input.error { border-color: var(--bo-red); }
        input.error:focus { box-shadow: 0 0 0 3px rgba(197,48,48,0.12); }

        .field-error {
            font-size: 12px;
            color: var(--bo-red);
            font-weight: 500;
            margin-top: 5px;
        }

        .toggle-pw {
            position: absolute;
            right: 13px; top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #aaa;
            padding: 0;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }
        .toggle-pw:hover { color: var(--bo-blue); }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--bo-blue), var(--bo-dark-blue));
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.04em;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(197,48,48,0.32);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Spinner */
        .spinner {
            width: 18px; height: 18px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>

<body>
<div class="login-wrapper">
    {{-- Logo / Brand --}}
    <div class="dhs-badge">
        <div class="dhs-logo-mark">
            <img src="{{ asset('image/LogoDHS_2.jpeg') }}" alt="DHS Logo" style="width:100%;height:100%;object-fit:contain;border-radius:inherit;">
        </div>
        <h1 class="dhs-wordmark">Denpasar Hotel School</h1>
        <p class="dhs-subtitle">Backoffice Admin Panel</p>
    </div>

    {{-- Login Card — no x-cloak so form shows immediately --}}
    <div class="login-card" x-data="loginForm()">

        {{-- Server-side error (backend flash placeholder) --}}
        @if($errors->has('auth'))
            <div class="error-alert">
                <span class="material-icons-round" style="font-size:18px;flex-shrink:0;margin-top:1px;">error_outline</span>
                <span>{{ $errors->first('auth') }}</span>
            </div>
        @endif

        {{-- Frontend error --}}
        <div class="error-alert" x-show="frontendError" x-transition style="display:none;">
            <span class="material-icons-round" style="font-size:18px;flex-shrink:0;margin-top:1px;">error_outline</span>
            <span x-text="frontendError"></span>
        </div>

        <h2>Selamat Datang</h2>
        <p>Masuk ke panel administrasi DHS</p>

        <form method="POST" action="/backoffice/login" @submit.prevent="handleSubmit($event)">
            @csrf

            {{-- Username --}}
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrap">
                    <span class="material-icons-round input-icon">person_outline</span>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        x-model="username"
                        placeholder="Masukkan username"
                        autocomplete="username"
                        :class="{ 'error': errors.username }"
                        value="{{ old('username') }}"
                    >
                </div>
                <div class="field-error" x-show="errors.username" x-text="errors.username"></div>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <span class="material-icons-round input-icon">lock_outline</span>
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        id="password"
                        name="password"
                        x-model="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        :class="{ 'error': errors.password }"
                    >
                    <button type="button" class="toggle-pw" @click="showPassword = !showPassword">
                        <span class="material-icons-round" style="font-size:19px;" x-text="showPassword ? 'visibility_off' : 'visibility'">visibility</span>
                    </button>
                </div>
                <div class="field-error" x-show="errors.password" x-text="errors.password"></div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login" :disabled="loading">
                <template x-if="loading">
                    <div class="spinner"></div>
                </template>
                <template x-if="!loading">
                    <span class="material-icons-round" style="font-size:18px;">login</span>
                </template>
                <span x-text="loading ? 'Memproses...' : 'Masuk'">Masuk</span>
            </button>
        </form>
    </div>
</div>

{{-- Alpine.js — specific version --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
<script>
    function loginForm() {
        return {
            username: '{{ old("username") }}',
            password: '',
            showPassword: false,
            loading: false,
            frontendError: '',
            errors: { username: '', password: '' },

            handleSubmit(e) {
                this.errors = { username: '', password: '' };
                this.frontendError = '';

                if (!this.username.trim()) {
                    this.errors.username = 'Username tidak boleh kosong.';
                }
                if (!this.password.trim()) {
                    this.errors.password = 'Password tidak boleh kosong.';
                }

                if (this.errors.username || this.errors.password) return;

                // Submit form untuk validasi backend
                this.loading = true;
                e.target.submit();
            }
        };
    }
</script>
</body>
</html>
