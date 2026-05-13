<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function toggle(Aspiration $aspiration)
{
    $existingVote = Vote::where('user_id', Auth::id())
        ->where('id_aspiration', $aspiration->id)
        ->first();

    // Jika sudah vote → hapus
    if ($existingVote) {

        $existingVote->delete();

        $voted = false;
    }

    // Jika belum vote → tambah
    else {

        Vote::create([
            'user_id' => Auth::id(),
            'id_aspiration' => $aspiration->id,
        ]);

        $voted = true;
    }

    // Hitung total vote terbaru
    $totalVotes = Vote::where('id_aspiration', $aspiration->id)->count();

    return response()->json([
        'success' => true,
        'voted' => $voted,
        'totalVotes' => $totalVotes,
    ]);
}
}