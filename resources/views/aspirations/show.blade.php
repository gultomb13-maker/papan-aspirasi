@extends('layouts.app')

@section('title', $aspiration->title)

@section('content')

<div class="max-w-3xl mx-auto">

    <article class="bg-white rounded-2xl shadow p-8">

        <div class="mb-4">
            <span class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                {{ $aspiration->category->name }}
            </span>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-4">
            {{ $aspiration->title }}
        </h1>

        <div class="text-sm text-gray-500 mb-6 flex gap-4">
            <span>
                Oleh:
                {{ $aspiration->user?->name ?? 'Anonim' }}
            </span>

            <span>
                {{ $aspiration->created_at->diffForHumans() }}
            </span>
        </div>

        <div class="prose max-w-none text-gray-700 whitespace-pre-line">
            {{ $aspiration->content }}
        </div>

        <div class="mt-8 pt-6 border-t flex items-center justify-between">

            <div class="text-gray-500">
                👍 {{ $aspiration->votes->count() }} dukungan
            </div>

            <a
                href="{{ route('aspirations.index') }}"
                class="text-blue-600 hover:underline"
            >
                ← Kembali
            </a>

        </div>

    </article>

</div>

@endsection