<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AspirationController extends Controller
{
    //  
    public function index()
{
    $aspirations = \App\Models\Aspiration::with('category')->get();

    return view('aspirations.index', [
        'aspirations' => $aspirations
    ]);
}
}
