<x-guest-layout>
    @push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f5efe6 !important;
            font-family: 'Patrick Hand', cursive;
            color: #2c2c2a;
        }

        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            padding: 2rem 1rem;
        }

        /* Kartu Register menggunakan warna pink (color-2) */
        .register-sticky-card {
            position: relative;
            background: #FFB3BA; 
            color: #4B1528;
            padding: 2.5rem 2rem 2rem;
            border-radius: 2px;
            box-shadow: 5px 8px 25px rgba(0,0,0,0.15);
            transform: rotate(1deg); /* Miring ke arah berbeda dari login */
            width: 100%;
            max-width: 450px;
        }

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

        .auth-title {
            font-family: 'Caveat', cursive;
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #4B1528;
        }

        .custom-form-group {
            margin-bottom: 1rem;
        }
        
        .custom-form-group input {
            font-family: 'Patrick Hand', cursive;
            font-size: 16px;
            background: transparent !important;
            border: none !important;
            border-bottom: 2px solid rgba(75, 21, 40, 0.3) !important;
            color: #4B1528 !important;
            padding: 6px 4px !important;
            outline: none !important;
            box-shadow: none !important;
            width: 100%;
        }

        .custom-form-group input:focus {
            border-bottom-color: #2c2c2a !important;
        }

        .custom-label {
            font-family: 'Caveat', cursive;
            font-size: 18px;
            font-weight: 700;
        }

        .btn-auth-submit {
            font-family: 'Caveat', cursive;
            font-size: 18px;
            font-weight: 700;
            background: #2c2c2a !important;
            color: #FAC775 !important;
            border: none;
            padding: 10px 24px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
            transition: transform 0.1s;
        }
        
        .btn-auth-submit:hover {
            transform: translateY(-2px);
            background: #412402 !important;
        }

        .auth-link {
            font-family: 'Patrick Hand', cursive;
            font-size: 14px;
            color: #4B1528;
            text-decoration: underline;
        }
    </style>
    @endpush

    <div class="auth-container">
        <div class="register-sticky-card">
            <div class="sticky-pin"></div>
            <h2 class="auth-title">📝 Daftar Akun Baru</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="custom-form-group">
                    <label for="name" class="custom-label">Nama Lengkap</label>
                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email Address -->
                <div class="custom-form-group mt-3">
                    <label for="email" class="custom-label">Alamat Email</label>
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="custom-form-group mt-3">
                    <label for="password" class="custom-label">Kata Sandi</label>
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="custom-form-group mt-3">
                    <label for="password_confirmation" class="custom-label">Konfirmasi Kata Sandi</label>
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="auth-link" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>

                    <button type="submit" class="btn-auth-submit" style="width: auto;">
                        Daftar Sekarang →
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>