<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Vote::create([
        'user_id' => 1,
        'id_aspiration' => 1
    ]);

    \App\Models\Vote::create([
        'user_id' => 1,
        'id_aspiration' => 2
    ]);
    }
}
