<nav class="bg-[#2c2c2a] shadow-md border-b border-black/10">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- LEFT -->
        <div class="flex items-center gap-6">

            <!-- Logo / Title -->
            <a href="{{ route('aspirations.index') }}"
               class="text-[#FAC775] text-2xl font-bold no-underline"
               style="font-family: 'Caveat', cursive;">
                📌 Papan Aspirasi
            </a>

            <!-- Home -->
            

        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-4">

            @auth

                <!-- Username -->
                <span class="text-[#f5efe6] text-sm">
                    {{ Auth::user()->name }}
                </span>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="bg-[#FAC775] hover:bg-[#EF9F27]
                               text-[#412402]
                               px-4 py-2 rounded-full
                               text-sm font-semibold
                               transition"
                    >
                        Logout
                    </button>
                </form>

            @else

                <a href="{{ route('login') }}"
                   class="text-[#f5efe6] hover:text-[#FAC775] transition no-underline">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="bg-[#FAC775]
                          hover:bg-[#EF9F27]
                          text-[#412402]
                          px-4 py-2 rounded-full
                          text-sm font-semibold
                          no-underline transition">
                    Register
                </a>

            @endauth

        </div>

    </div>

</nav>