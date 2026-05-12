@extends('layouts.app')

@section('title', 'Papan Aspirasi Kampus')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">
<style>
    body {
        background: #f5efe6 !important;
        font-family: 'Patrick Hand', cursive;
    }

    /* ── HEADER BAR ── */
    .board-header {
        background: #2c2c2a;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 2rem;
    }
    .board-title {
        font-family: 'Caveat', cursive;
        font-size: 28px;
        font-weight: 700;
        color: #f5efe6;
        letter-spacing: 0.5px;
        margin: 0;
    }

    /* ── SEARCH FORM ── */
    .search-form {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }
    .search-form input[type="text"],
    .search-form select {
        font-family: 'Patrick Hand', cursive;
        font-size: 14px;
        background: transparent;
        border: none;
        border-bottom: 2px solid rgba(245,239,230,0.5);
        color: #f5efe6;
        padding: 6px 10px;
        outline: none;
        min-width: 140px;
        transition: border-color 0.2s;
    }
    .search-form input[type="text"]::placeholder { color: rgba(245,239,230,0.5); }
    .search-form input[type="text"]:focus,
    .search-form select:focus { border-bottom-color: #FAC775; }
    .search-form select option { background: #2c2c2a; color: #f5efe6; }
    .btn-search {
        font-family: 'Caveat', cursive;
        font-size: 15px;
        font-weight: 700;
        background: #FAC775;
        color: #412402;
        border: none;
        padding: 7px 20px;
        border-radius: 4px;
        cursor: pointer;
        letter-spacing: 0.5px;
        transition: background 0.15s;
    }
    .btn-search:hover { background: #EF9F27; }

    /* ── STICKY GRID ── */
    .sticky-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem 1.5rem;
        padding: 0 1.5rem 3rem;
    }
    @media (max-width: 900px) {
        .sticky-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 580px) {
        .sticky-grid { grid-template-columns: 1fr; }
    }

    /* ── STICKY CARD ── */
    .sticky-card {
        position: relative;
        padding: 1.5rem 1.25rem 1.1rem;
        border-radius: 2px;
        min-height: 210px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .sticky-card:hover {
        transform: translateY(-5px) rotate(0deg) !important;
        box-shadow: 6px 10px 30px rgba(0,0,0,0.2) !important;
    }

    /* Pin */
    .sticky-pin {
        position: absolute;
        top: -11px;
        left: 50%;
        transform: translateX(-50%);
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: radial-gradient(circle at 35% 35%, #ffffff 20%, #aaaaaa 100%);
        border: 2px solid rgba(0,0,0,0.15);
        z-index: 2;
    }

    /* Category badge */
    .cat-badge {
        font-family: 'Caveat', cursive;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        opacity: 0.65;
    }

    /* Title */
    .sticky-card h3 {
        font-family: 'Caveat', cursive;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.25;
        margin: 0;
    }

    /* Content */
    .sticky-card .sticky-content {
        font-size: 14px;
        line-height: 1.6;
        flex: 1;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Footer */
    .sticky-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        margin-top: 6px;
        opacity: 0.65;
    }

    /* Vote button */
    .vote-form button,
    .vote-display {
        font-family: 'Caveat', cursive;
        font-size: 14px;
        font-weight: 700;
        background: rgba(0,0,0,0.08);
        border: none;
        border-radius: 20px;
        padding: 4px 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: background 0.15s;
        color: inherit;
    }
    .vote-form button:hover { background: rgba(0,0,0,0.16); }
    .vote-display { cursor: default; }

    /* ── COLOUR VARIANTS (6 cycling colours) ── */
    .color-1 { background: #FFF3A3; color: #2C2C2A; box-shadow: 3px 6px 20px rgba(0,0,0,0.13); transform: rotate(-1.5deg); }
    .color-2 { background: #FFB3BA; color: #4B1528; box-shadow: 3px 6px 20px rgba(0,0,0,0.13); transform: rotate(1deg); }
    .color-3 { background: #B5EAD7; color: #04342C; box-shadow: 3px 6px 20px rgba(0,0,0,0.13); transform: rotate(-0.8deg); }
    .color-4 { background: #C7CEEA; color: #26215C; box-shadow: 3px 6px 20px rgba(0,0,0,0.13); transform: rotate(1.5deg); }
    .color-5 { background: #FFDAC1; color: #4A1B0C; box-shadow: 3px 6px 20px rgba(0,0,0,0.13); transform: rotate(-1deg); }
    .color-6 { background: #E2F0CB; color: #173404; box-shadow: 3px 6px 20px rgba(0,0,0,0.13); transform: rotate(0.7deg); }

    /* ── WRITE BUTTON (FAB) ── */
    .fab-write {
        position: fixed;
        bottom: 28px;
        right: 28px;
        font-family: 'Caveat', cursive;
        font-size: 16px;
        font-weight: 700;
        background: #2c2c2a;
        color: #FAC775;
        border: none;
        padding: 13px 26px;
        border-radius: 30px;
        cursor: pointer;
        box-shadow: 0 4px 18px rgba(0,0,0,0.28);
        letter-spacing: 0.5px;
        text-decoration: none;
        display: inline-block;
        transition: transform 0.15s, box-shadow 0.15s;
        z-index: 50;
    }
    .fab-write:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 22px rgba(0,0,0,0.32);
        color: #FAC775;
        text-decoration: none;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 1rem;
        font-family: 'Caveat', cursive;
        font-size: 22px;
        color: #888780;
    }
</style>
@endpush

@section('content')

{{-- HEADER --}}
<div class="board-header">
    <span class="board-title">📌 Papan Aspirasi Kampus</span>

    <form method="GET" action="{{ route('aspirations.index') }}" class="search-form">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari aspirasi..."
        >

        <select name="category">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn-search">Cari →</button>
    </form>
</div>

{{-- STICKY GRID --}}
<div class="sticky-grid">

    @forelse ($aspirations as $index => $aspiration)
        @php $colorClass = 'color-' . (($index % 6) + 1); @endphp

        <article class="sticky-card {{ $colorClass }}">
            <div class="sticky-pin"></div>

            <span class="cat-badge">{{ $aspiration->category->name }}</span>

            <h3>{{ $aspiration->title }}</h3>

            <p class="sticky-content">{{ $aspiration->content }}</p>

            <div class="sticky-footer">
                <span>{{ $aspiration->created_at->diffForHumans() }}</span>

                @auth
                    <form class="vote-form" action="{{ route('aspirations.vote', $aspiration->id) }}" method="POST">
                        @csrf
                        <button type="submit">
                            👍 {{ $aspiration->votes->count() }} dukungan
                        </button>
                    </form>
                @else
                    <span class="vote-display">
                        👍 {{ $aspiration->votes->count() }}
                    </span>
                @endauth
            </div>
        </article>

    @empty
        <div class="empty-state">
            ✏️ Belum ada aspirasi. Jadilah yang pertama!
        </div>
    @endforelse

</div>

{{-- FAB: Tulis Aspirasi (hanya untuk user login) --}}
@auth
    <a href="{{ route('aspirations.create') }}" class="fab-write">
        ✏️ Tulis Aspirasi
    </a>
@endauth

@endsection