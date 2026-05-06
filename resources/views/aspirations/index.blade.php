@extends('layouts.app')

@section('title', 'Papan Aspirasi Kampus')

@section('content')
<div class="space-y-6">
    @foreach ($aspirations as $aspiration)
        <article class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_25px_-2px_rgba(0,0,0,0.08)] transition-all duration-300 p-6 flex flex-col gap-3">
            <div>
                <span class="inline-flex items-center text-xs font-semibold uppercase tracking-wider text-blue-600 bg-blue-50/70 px-2.5 py-1 rounded-md">
                    {{ $aspiration->category->name }}
                </span>
            </div>

            <h3 class="text-lg font-bold text-gray-900 leading-snug hover:text-blue-600 transition-colors cursor-pointer">
                {{ $aspiration->title }}
            </h3>

            <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
                {{ $aspiration->content }}
            </p>

            <div class="border-t border-gray-50 pt-4 mt-2 flex items-center justify-between text-xs text-gray-400">
                <span>{{ $aspiration->created_at->diffForHumans() }}</span>
                <div class="flex gap-4">
                    <button class="hover:text-blue-600 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.757a2 2 0 110 4h-1.121l-1.341 4.693A2 2 0 0114.4 20H8.4a2 2 0 01-1.9-1.307L5.16 14H4a2 2 0 110-4h1.16l1.34-4.693A2 2 0 018.4 4h6a2 2 0 011.9 1.307L17.64 10H14z"></path></svg>
                        Mendukung
                    </button>
                </div>
            </div>
        </article>
    @endforeach
</div>
@endsection