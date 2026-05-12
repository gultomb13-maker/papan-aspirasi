@extends('layouts.app')

@section('title', 'Kirim Aspirasi')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">
<style>
    body {
        background: #f5efe6 !important;
        font-family: 'Patrick Hand', cursive;
    }

    .create-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 1rem;
    }

    /* Big sticky note card */
    .sticky-form-card {
        background: #FFF3A3;
        color: #2C2C2A;
        border-radius: 2px;
        padding: 2.5rem 2rem 2rem;
        width: 100%;
        max-width: 520px;
        box-shadow: 6px 10px 30px rgba(0,0,0,0.18);
        position: relative;
        transform: rotate(-0.4deg);
    }

    /* Pin at top */
    .sticky-pin {
        position: absolute;
        top: -13px;
        left: 50%;
        transform: translateX(-50%);
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: radial-gradient(circle at 35% 35%, #ffffff 20%, #999999 100%);
        border: 2px solid rgba(0,0,0,0.15);
        z-index: 2;
    }

    .form-heading {
        font-family: 'Caveat', cursive;
        font-size: 30px;
        font-weight: 700;
        margin: 0 0 1.5rem;
        line-height: 1.2;
        color: #2C2C2A;
    }
    .form-heading span {
        display: block;
        font-size: 15px;
        font-weight: 400;
        font-family: 'Patrick Hand', cursive;
        opacity: 0.6;
        margin-top: 4px;
    }

    /* Ruled lines under each field like actual notepad paper */
    .field-wrap {
        margin-bottom: 1.4rem;
    }
    .field-label {
        font-family: 'Caveat', cursive;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        opacity: 0.55;
        margin-bottom: 6px;
        display: block;
    }

    .field-wrap input[type="text"],
    .field-wrap select,
    .field-wrap textarea {
        font-family: 'Patrick Hand', cursive;
        font-size: 16px;
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 2px solid rgba(44,44,42,0.25);
        padding: 6px 2px;
        outline: none;
        color: #2C2C2A;
        transition: border-color 0.2s;
        border-radius: 0;
        box-sizing: border-box;
    }
    .field-wrap input[type="text"]:focus,
    .field-wrap select:focus,
    .field-wrap textarea:focus {
        border-bottom-color: rgba(44,44,42,0.7);
    }
    .field-wrap input::placeholder,
    .field-wrap textarea::placeholder {
        color: rgba(44,44,42,0.35);
        font-style: italic;
    }
    .field-wrap select option { background: #FFF3A3; color: #2C2C2A; }

    .field-wrap textarea {
        resize: none;
        line-height: 1.8;
        /* Lined notebook effect */
        background-image: repeating-linear-gradient(
            to bottom,
            transparent,
            transparent 31px,
            rgba(44,44,42,0.12) 31px,
            rgba(44,44,42,0.12) 32px
        );
        background-attachment: local;
    }

    /* Divider */
    .form-divider {
        border: none;
        border-top: 1.5px dashed rgba(44,44,42,0.2);
        margin: 1.5rem 0;
    }

    /* Submit button */
    .btn-submit {
        font-family: 'Caveat', cursive;
        font-size: 18px;
        font-weight: 700;
        background: #2c2c2a;
        color: #FAC775;
        border: none;
        padding: 12px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        letter-spacing: 0.5px;
        transition: background 0.15s, transform 0.1s;
    }
    .btn-submit:hover { background: #444441; }
    .btn-submit:active { transform: scale(0.98); }

    /* Back link */
    .back-link {
        display: block;
        text-align: center;
        margin-top: 1rem;
        font-family: 'Caveat', cursive;
        font-size: 15px;
        color: rgba(44,44,42,0.55);
        text-decoration: none;
        transition: color 0.15s;
    }
    .back-link:hover { color: rgba(44,44,42,0.85); }

    /* Validation errors */
    .error-msg {
        font-size: 12px;
        color: #993C1D;
        margin-top: 4px;
        font-family: 'Patrick Hand', cursive;
    }
</style>
@endpush

@section('content')
<div class="create-wrapper">
    <div class="sticky-form-card">
        <div class="sticky-pin"></div>

        <h2 class="form-heading">
            ✏️ Sampaikan Aspirasimu
            <span>Tuliskan dengan jujur, kami mendengar.</span>
        </h2>

        <form action="{{ route('aspirations.store') }}" method="POST">
            @csrf

            {{-- Judul --}}
            <div class="field-wrap">
                <label class="field-label" for="title">Judul</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Contoh: Perbaikan Fasilitas Kantin"
                    required
                >
                @error('title')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="field-wrap">
                <label class="field-label" for="category_id">Kategori</label>
                <select id="category_id" name="category_id" required>
                    <option value="">— Pilih kategori —</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <hr class="form-divider">

            {{-- Isi aspirasi --}}
            <div class="field-wrap">
                <label class="field-label" for="content">Isi Aspirasi</label>
                <textarea
                    id="content"
                    name="content"
                    rows="6"
                    placeholder="Ceritakan aspirasimu secara detail..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Kirim Sekarang 📮
            </button>
        </form>

        <a href="{{ route('aspirations.index') }}" class="back-link">← Kembali ke papan</a>
    </div>
</div>
@endsection