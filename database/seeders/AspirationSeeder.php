<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AspirationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    \App\Models\Aspiration::create([
        'user_id' => 1,
        'category_id' => 1,
        'title' => 'Perbaikan Sistem KRS',
        'content' => 'Sistem KRS sering down.',
    ]);

    \App\Models\Aspiration::create([
        'user_id' => 1,
        'category_id' => 2,
        'title' => 'WiFi Lemah',
        'content' => 'Internet kampus lambat.',
    ]);
    }
}
