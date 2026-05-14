@extends('layouts.app')

@section('title', $aspiration->title)

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">
<style>
    body { background: #f5efe6 !important; font-family: 'Patrick Hand', cursive; }
</style>
@endpush

@section('content')

<div style="max-width: 720px; margin: 0 auto;">

    {{-- Tombol kembali --}}
    <a href="{{ route('aspirations.index') }}"
       style="display: inline-flex; align-items: center; gap: 6px; font-family: 'Caveat', cursive; font-size: 18px; font-weight: 700; color: #2c2c2a; text-decoration: none; margin-bottom: 1.5rem; opacity: 0.7; transition: opacity 0.2s;"
       onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">
        ← Kembali ke Papan
    </a>

    {{-- Card utama (sticky note besar) --}}
    <article style="background: #FFF3A3; color: #2C2C2A; border-radius: 2px; padding: 3rem 3rem 2.5rem; position: relative; box-shadow: 6px 8px 28px rgba(0,0,0,0.12); transform: rotate(-0.3deg);">

        {{-- Pin --}}
        <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); width: 26px; height: 26px; border-radius: 50%; background: radial-gradient(circle at 35% 35%, #ffffff 20%, #aaaaaa 100%); border: 2px solid rgba(0,0,0,0.15); box-shadow: 0 3px 6px rgba(0,0,0,0.1);"></div>

        {{-- Kategori --}}
        <span style="font-family: 'Caveat', cursive; font-size: 14px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; opacity: 0.6;">
            {{ $aspiration->category->name }}
        </span>

        {{-- Judul --}}
        <h1 style="font-family: 'Caveat', cursive; font-size: 40px; font-weight: 700; line-height: 1.2; margin: 0.5rem 0 1.5rem; color: #2C2C2A;">
            {{ $aspiration->title }}
        </h1>

        {{-- Meta --}}
        <div style="font-size: 15px; opacity: 0.65; margin-bottom: 2rem; display: flex; gap: 1.5rem; flex-wrap: wrap;">
            <span>👤 {{ $aspiration->user?->name ?? 'Anonim' }}</span>
            <span>🕐 {{ $aspiration->created_at->diffForHumans() }}</span>
        </div>

        {{-- Garis dashed pemisah --}}
        <div style="border-top: 1.5px dashed rgba(0,0,0,0.15); margin-bottom: 2rem;"></div>

        {{-- Isi konten --}}
        <div style="font-size: 18px; line-height: 1.8; white-space: pre-line; color: #2C2C2A;">
            {{ $aspiration->content }}
        </div>

        {{-- Footer --}}
        <div style="margin-top: 2.5rem; padding-top: 1rem; border-top: 1.5px dashed rgba(0,0,0,0.15); display: flex; align-items: center; justify-content: flex-start; gap: 8px; font-family: 'Caveat', cursive; font-size: 18px; font-weight: 700; opacity: 0.75;">
            👍 {{ $aspiration->votes->count() }} dukungan
        </div>

    </article>

</div>

@endsection