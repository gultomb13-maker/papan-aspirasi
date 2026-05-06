@extends('layouts.app')

@section('title', 'Kirim Aspirasi')

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-blue-600 pb-2 inline-block">Sampaikan Aspirasimu</h2>
    
    <form action="{{ route('aspirations.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Aspirasi</label>
            <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition" placeholder="Contoh: Perbaikan Fasilitas Kantin" required>
        </div>

        <div>
            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
            <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition" required>
    <option value="">-- Pilih Kategori --</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>
        </div>

        <div>
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Isi Aspirasi</label>
            <textarea id="content" name="content" rows="5" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Jelaskan aspirasi Anda secara detail..." required></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-all shadow-md active:transform active:scale-[0.98]">
            Kirim Sekarang
        </button>
    </form>
</div>
@endsection