<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function toggle(int $id)
    {
        // Cari aspirasi berdasarkan ID
        $aspiration = Aspiration::findOrFail($id);

        // Cek apakah user sudah vote
        $existingVote = Vote::where('user_id', Auth::id())
            ->where('id_aspiration', $aspiration->id)
            ->first();

        // Jika sudah vote → hapus vote
        if ($existingVote) {
            $existingVote->delete();
        }

        // Jika belum vote → tambah vote
        else {
            Vote::create([
                'user_id' => Auth::id(),
                'id_aspiration' => $aspiration->id,
            ]);
        }

        return redirect()->back();
    }
}