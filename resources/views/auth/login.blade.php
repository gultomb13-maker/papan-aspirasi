<x-guest-layout>
    @push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght=400;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">
    <style>
        /* Mengganti font & background guest layout agar sama dengan dashboard */
        body {
            background: #f5efe6 !important;
            font-family: 'Patrick Hand', cursive;
            color: #2c2c2a;
        }

        /* Container utama pembungkus kartu mading */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 1rem;
        }

        /* Kartu Login bergaya Sticky Note Kuning */
        .login-sticky-card {
            position: relative;
            background: #FFF3A3; /* Mengambil varian warna color-1 dari dashboard */
            color: #2C2C2A;
            padding: 2.5rem 2rem 2rem;
            border-radius: 2px;
            box-shadow: 5px 8px 25px rgba(0,0,0,0.15);
            transform: rotate(-1deg); /* Efek miring khas mading */
            width: 100%;
            max-width: 420px;
        }

        /* Pin mading di atas kartu */
        .sticky-pin {
            position: absolute;
            top: -11px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #ffffff 20%, #aaaaaa 100%);
            border: 2px solid rgba(0,0,0,0.15);
            z-index: 2;
        }

        /* Judul Login bergaya tulisan tangan */
        .login-title {
            font-family: 'Caveat', cursive;
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c2c2a;
        }

        /* Penyelarasan gaya form input text */
        .custom-form-group {
            margin-bottom: 1.25rem;
        }
        
        /* Memaksa input field Laravel Breeze mengikuti gaya coretan pulpen */
        .custom-form-group input[type="email"],
        .custom-form-group input[type="password"] {
            font-family: 'Patrick Hand', cursive;
            font-size: 16px;
            background: transparent !important;
            border: none !important;
            border-bottom: 2px solid rgba(44, 44, 42, 0.3) !important;
            color: #2c2c2a !important;
            padding: 6px 4px !important;
            outline: none !important;
            box-shadow: none !important;
            width: 100%;
            transition: border-color 0.2s;
        }

        .custom-form-group input:focus {
            border-bottom-color: #EF9F27 !important; /* Warna hover orange/kuning dari dashboard */
        }

        /* Mengubah font label bawaan */
        .custom-label {
            font-family: 'Caveat', cursive;
            font-size: 18px;
            font-weight: 700;
            color: #2c2c2a !important;
        }

        /* Tombol Masuk bergaya tombol Cari di Dashboard */
        .btn-login-submit {
            font-family: 'Caveat', cursive;
            font-size: 18px;
            font-weight: 700;
            background: #2c2c2a !important; /* Dibuat gelap agar kontras dengan kertas kuning */
            color: #FAC775 !important;
            border: none;
            padding: 8px 24px;
            border-radius: 4px;
            cursor: pointer;
            letter-spacing: 0.5px;
            transition: background 0.15s, transform 0.1s;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        
        .btn-login-submit:hover {
            background: #412402 !important;
            transform: translateY(-1px);
        }

        /* Link teks bawah */
        .login-link {
            font-family: 'Patrick Hand', cursive;
            font-size: 14px;
            color: #2c2c2a;
            text-decoration: underline;
            transition: color 0.15s;
        }
        .login-link:hover {
            color: #EF9F27;
        }
    </style>
    @endpush

    <div class="login-container">
        <div class="login-sticky-card">
            <div class="sticky-pin"></div>

            <h2 class="login-title">📌 Masuk ke Papan</h2>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="custom-form-group">
                    <label for="email" class="custom-label">Surat Elektronik (Email)</label>
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="custom-form-group mt-4">
                    <label for="password" class="custom-label">Kata Sandi (Password)</label>
                    <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div class="flex items-center justify-between mt-4 mb-6">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-400 text-amber-600 shadow-sm focus:ring-amber-500 bg-transparent" name="remember">
                        <span class="ms-2 text-sm text-gray-700 font-medium" style="font-family: 'Patrick Hand', cursive;">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="login-link" href="{{ route('password.request') }}">
                            Lupa sandi?
                        </a>
                    @endif
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn-login-submit">
                        Buka Papan Aspirasi →
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-sm text-gray-600">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="login-link ms-1">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>