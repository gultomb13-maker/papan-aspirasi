@extends('layouts.app')

@section('title', 'Papan Aspirasi Kampus')
@section('fullwidth')@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">
<style>
    /* === TEMA GLOBAL === */
    body {
        background-color: #e8dcc8 !important;
        /* Tekstur corkboard: dot grid halus */
        background-image: radial-gradient(circle, rgba(0,0,0,0.08) 1px, transparent 1px);
        background-size: 22px 22px;
        font-family: 'Patrick Hand', cursive;
    }

    /* === GRID MASONRY (CSS Columns) === */
    .sticky-grid {
        column-count: 3;
        column-gap: 1.8rem;
        padding: 2.5rem 2.5rem 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    @media (max-width: 900px) { .sticky-grid { column-count: 2; } }
    @media (max-width: 580px) { .sticky-grid { column-count: 1; } }

    /* === STICKY CARD === */
    .sticky-card {
        display: inline-block; /* wajib untuk masonry */
        width: 100%;
        break-inside: avoid;  /* cegah card terpotong antar kolom */
        margin-bottom: 2rem;
        position: relative;
        padding: 2rem 1.75rem 1.5rem;
        border-radius: 2px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* Variasi rotasi — nth-child agar konsisten tiap page */
    .sticky-card:nth-child(6n+1) { transform: rotate(-1.5deg); }
    .sticky-card:nth-child(6n+2) { transform: rotate(1.2deg); }
    .sticky-card:nth-child(6n+3) { transform: rotate(-0.6deg); }
    .sticky-card:nth-child(6n+4) { transform: rotate(1.8deg); }
    .sticky-card:nth-child(6n+5) { transform: rotate(-1deg); }
    .sticky-card:nth-child(6n+6) { transform: rotate(0.7deg); }

    .sticky-card:hover {
        transform: translateY(-8px) rotate(0deg) !important;
        box-shadow: 10px 16px 36px rgba(0,0,0,0.2) !important;
        z-index: 10;
    }

    /* Pin di atas card */
    .sticky-pin {
        position: absolute;
        top: -12px; left: 50%;
        transform: translateX(-50%);
        width: 22px; height: 22px;
        border-radius: 50%;
        background: radial-gradient(circle at 35% 35%, #fff 20%, #aaa 100%);
        border: 2px solid rgba(0,0,0,0.15);
        box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        z-index: 2;
    }

    /* === TEKS DALAM CARD === */
    .cat-badge {
        font-family: 'Caveat', cursive;
        font-size: 13px; font-weight: 700;
        letter-spacing: 1.5px; text-transform: uppercase; opacity: 0.65;
    }
    .sticky-card h3 {
        font-family: 'Caveat', cursive;
        font-size: 25px; font-weight: 700;
        line-height: 1.3; margin: 4px 0 10px; color: inherit;
    }
    .sticky-card a { text-decoration: none; color: inherit; }
    .sticky-content {
        font-size: 15px; line-height: 1.65; margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Footer card: waktu + vote */
    .sticky-footer {
        display: flex; align-items: center; justify-content: space-between;
        font-size: 13px; margin-top: 1.4rem; padding-top: 10px;
        border-top: 1px dashed rgba(0,0,0,0.12); opacity: 0.8;
    }

    /* Tombol vote (AJAX) & display vote */
    .vote-button, .vote-display {
        font-family: 'Caveat', cursive; font-size: 15px; font-weight: 700;
        background: rgba(0,0,0,0.08); border: none; border-radius: 20px;
        padding: 5px 14px; cursor: pointer;
        display: inline-flex; align-items: center; gap: 5px;
        transition: background 0.15s; color: inherit;
    }
    .vote-button:hover { background: rgba(0,0,0,0.16); }
    .vote-display { cursor: default; }

    /* === WARNA CARD (6 varian) === */
    .color-1 { background: #FFF3A3; color: #2C2C2A; box-shadow: 4px 6px 20px rgba(0,0,0,0.1); }
    .color-2 { background: #FFB3BA; color: #4B1528; box-shadow: 4px 6px 20px rgba(0,0,0,0.1); }
    .color-3 { background: #B5EAD7; color: #04342C; box-shadow: 4px 6px 20px rgba(0,0,0,0.1); }
    .color-4 { background: #C7CEEA; color: #26215C; box-shadow: 4px 6px 20px rgba(0,0,0,0.1); }
    .color-5 { background: #FFDAC1; color: #4A1B0C; box-shadow: 4px 6px 20px rgba(0,0,0,0.1); }
    .color-6 { background: #E2F0CB; color: #173404; box-shadow: 4px 6px 20px rgba(0,0,0,0.1); }


    /* === FAB TULIS ASPIRASI === */
    .fab-write {
        position: fixed; bottom: 30px; right: 30px; z-index: 50;
        font-family: 'Caveat', cursive; font-size: 18px; font-weight: 700;
        background: #2c2c2a; color: #FAC775;
        border: 2px solid rgba(250,199,117,0.3);
        padding: 13px 26px; border-radius: 40px;
        text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
        box-shadow: 0 6px 24px rgba(0,0,0,0.25);
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }
    .fab-write:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3), 0 0 0 6px rgba(250,199,117,0.1);
        border-color: rgba(250,199,117,0.55);
        color: #FAC775; text-decoration: none;
    }

    /* === PAGINATION === */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin: 2rem 0 4rem;
    flex-wrap: wrap;
    padding-bottom: 5rem;
}

.pagination-info {
    font-family: 'Caveat', cursive;
    font-size: 18px;
    color: #4b463f;
}

.pagination-wrapper nav {
    display: flex;
    align-items: center;
}

    /* === EMPTY STATE === */
    .empty-state {
        text-align: center; padding: 6rem 1rem;
        font-family: 'Caveat', cursive; font-size: 26px; color: #7a7060;
    }
</style>
@endpush

@section('content')

{{-- Masonry grid sticky notes --}}
<div class="sticky-grid">
    @forelse ($aspirations as $index => $aspiration)
        @php $colorClass = 'color-' . (($index % 6) + 1); @endphp

        <article class="sticky-card {{ $colorClass }}">
            <div class="sticky-pin"></div>
            <span class="cat-badge">{{ $aspiration->category->name }}</span>

            <a href="{{ route('aspirations.show', $aspiration->id) }}">
                <h3>{{ $aspiration->title }}</h3>
            </a>

            <p class="sticky-content">{{ $aspiration->content }}</p>

            <div class="sticky-footer">
                <span>{{ $aspiration->created_at->diffForHumans() }}</span>

                @auth
                    {{-- Tombol vote — dikirim via AJAX, lihat script di bawah --}}
                    <button class="vote-button" data-id="{{ $aspiration->id }}">
                        👍 <span id="vote-count-{{ $aspiration->id }}">{{ $aspiration->votes->count() }}</span> dukungan
                    </button>
                @else
                    <span class="vote-display">👍 {{ $aspiration->votes->count() }}</span>
                @endauth
            </div>
        </article>

    @empty
        <div class="empty-state">✏️ Belum ada aspirasi!</div>
    @endforelse
</div>

<div class="pagination-wrapper">

    <div class="pagination-info">
        Showing {{ $aspirations->firstItem() }}
        to {{ $aspirations->lastItem() }}
        of {{ $aspirations->total() }}
    </div>

    {{ $aspirations->links() }}

</div>

{{-- FAB: hanya muncul saat login --}}
@auth
    <a href="{{ route('aspirations.create') }}" class="fab-write">✏️ Tulis Aspirasi</a>
@endauth

<script>
// === AJAX Vote ===
document.querySelectorAll('.vote-button').forEach(btn => {
    btn.addEventListener('click', async function () {
        try {
            const res = await fetch(`/aspirations/${this.dataset.id}/vote`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            });
            const data = await res.json();
            document.getElementById(`vote-count-${this.dataset.id}`).innerText = data.totalVotes;
        } catch (e) { console.error('Vote gagal:', e); }
    });
});

</script>

@endsection