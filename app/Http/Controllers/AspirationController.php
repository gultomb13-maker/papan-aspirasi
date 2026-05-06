<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use App\Models\Category;

class AspirationController extends Controller
{
    // Menampilkan daftar semua aspirasi (Campuran DB + Session)
    public function index()
    {
        // 1. Ambil data asli dari DB (jika ada)
        $realAspirations = Aspiration::with('category')->latest()->get();

        // 2. Ambil data demo dari session
        $fakeAspirations = collect(session('demo_aspirations', []));

        // 3. Gabungkan: Data baru di session akan muncul paling atas
        $aspirations = $fakeAspirations->merge($realAspirations);

        return view('aspirations.index', [
            'aspirations' => $aspirations
        ]);
    }

    public function create()
    {
        $categories = Category::all(); 
        return view('aspirations.create', compact('categories'));
    }

    // BYPASS MODE: Simpan ke Session saja untuk demo
    public function store(Request $request)
    {
        // Tetap validasi agar terlihat profesional saat demo jika ada input kosong
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'content' => 'required|string',
        ]);

        // Buat objek palsu agar strukturnya mirip model aslinya
        $newAspiration = (object) [
            'title' => $request->title,
            'content' => $request->content,
            'created_at' => now(),
            'category' => (object) [
                'name' => $request->category_id == 1 ? 'Akademik' : ($request->category_id == 2 ? 'Fasilitas' : 'Lainnya')
            ]
        ];

        // Masukkan ke dalam "tas" session
        $currentDemos = session('demo_aspirations', []);
        array_unshift($currentDemos, $newAspiration); // Tambahkan ke urutan paling atas
        session(['demo_aspirations' => $currentDemos]);

        return redirect()->route('aspirations.index')->with('success', 'Aspirasi terkirim (Demo Mode)!');
    }
}