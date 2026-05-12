<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AspirationController extends Controller
{
    // Menampilkan daftar semua aspirasi + dari session
    public function index(Request $request)
{
    $query = Aspiration::with('category')->latest();
    $aspirations = Aspiration::with(['category', 'user', 'votes'])
    ->latest()
    ->get();

    // SEARCH
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
        });
    }

    // FILTER KATEGORI
    if ($request->category) {
        $query->where('category_id', $request->category);
    }

    $aspirations = $query->get();

    $categories = Category::all();

    return view('aspirations.index', [
        'aspirations' => $aspirations,
        'categories' => $categories,
    ]);
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
        'user_id' => Auth::id(),
    ]);

    return redirect()->route('aspirations.index')
        ->with('success', 'Aspirasi berhasil dikirim!');
}
}