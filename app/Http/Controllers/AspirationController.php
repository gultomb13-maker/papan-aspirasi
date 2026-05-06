<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use App\Models\Category;

class AspirationController extends Controller
{
    // Menampilkan daftar semua aspirasi + dari session
    public function index()
{
    $aspirations = Aspiration::with('category')->latest()->get();

    return view('aspirations.index', compact('aspirations'));
}

    public function create()
    {
        $categories = Category::all(); 
        return view('aspirations.create', compact('categories'));
    }

    //Input form masih simpan ke Session  untuk demo
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required|string',
    ]);

    // Simpan ke database
    Aspiration::create([
        'title' => $request->title,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'user_id' => 1, // sementara (dummy user)
    ]);

    return redirect()->route('aspirations.index')
        ->with('success', 'Aspirasi berhasil dikirim!');
}
}