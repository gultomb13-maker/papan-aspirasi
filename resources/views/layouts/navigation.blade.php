<nav style="background: #2c2c2a; border-bottom: 1px solid rgba(0,0,0,0.2); position: sticky; top: 0; z-index: 100;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; gap: 1.5rem;">

        {{-- LOGO --}}
        <a href="{{ route('aspirations.index') }}"
           style="font-family: 'Caveat', cursive; color: #FAC775; font-size: 22px; font-weight: 700; text-decoration: none; white-space: nowrap; flex-shrink: 0;">
            📌 Papan Aspirasi
        </a>

        {{-- SEARCH FORM --}}
        <form method="GET" action="{{ route('aspirations.index') }}"
              style="flex: 1; display: flex; align-items: center; gap: 10px; max-width: 700px;">

            {{-- Search input --}}
            <div style="flex: 1; position: relative;">
                <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #888780; font-size: 15px;">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari aspirasi..."
                       style="width: 100%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 25px; color: #f5efe6; padding: 8px 14px 8px 36px; font-family: 'Patrick Hand', cursive; font-size: 14px; outline: none; box-sizing: border-box; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='rgba(250,199,117,0.5)'"
                       onblur="this.style.borderColor='rgba(255,255,255,0.12)'">
            </div>

            {{-- Category select --}}
            <select name="category" onchange="this.form.submit()"
                    style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 25px; color: #f5efe6; padding: 8px 14px; font-family: 'Patrick Hand', cursive; font-size: 14px; outline: none; cursor: pointer;">
                <option value="" class="text-black">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" class="text-black"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            {{-- Sort select --}}
            <select name="sort" onchange="this.form.submit()"
                    style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 25px; color: #f5efe6; padding: 8px 14px; font-family: 'Patrick Hand', cursive; font-size: 14px; outline: none; cursor: pointer;">
                <option value="" class="text-black">🕐 Terbaru</option>
                <option value="popular" class="text-black" {{ request('sort') == 'popular' ? 'selected' : '' }}>
                    🔥 Terpopuler
                </option>
            </select>

            {{-- Search button --}}
            <button type="submit"
                    style="background: #FAC775; color: #412402; border: none; border-radius: 25px; padding: 8px 20px; font-family: 'Patrick Hand', cursive; font-size: 14px; font-weight: 700; cursor: pointer; white-space: nowrap; flex-shrink: 0; transition: background 0.2s;"
                    onmouseover="this.style.background='#EF9F27'"
                    onmouseout="this.style.background='#FAC775'">
                Cari
            </button>
        </form>

        {{-- RIGHT: Auth --}}
        <div style="display: flex; align-items: center; gap: 12px; flex-shrink: 0;">
            @auth
                <span style="color: #f5efe6; font-family: 'Patrick Hand', cursive; font-size: 14px; opacity: 0.8;">
                    👤 {{ Auth::user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            style="background: transparent; border: 1px solid rgba(250,199,117,0.4); border-radius: 25px; color: #FAC775; padding: 7px 18px; font-family: 'Patrick Hand', cursive; font-size: 14px; cursor: pointer; transition: all 0.2s;"
                            onmouseover="this.style.background='rgba(250,199,117,0.1)'"
                            onmouseout="this.style.background='transparent'">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   style="color: #f5efe6; text-decoration: none; font-family: 'Patrick Hand', cursive; font-size: 14px; opacity: 0.8; transition: opacity 0.2s;"
                   onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   style="background: #FAC775; color: #412402; border-radius: 25px; padding: 7px 18px; font-family: 'Patrick Hand', cursive; font-size: 14px; font-weight: 700; text-decoration: none; transition: background 0.2s;"
                   onmouseover="this.style.background='#EF9F27'" onmouseout="this.style.background='#FAC775'">
                    Register
                </a>
            @endauth
        </div>

    </div>
</nav>