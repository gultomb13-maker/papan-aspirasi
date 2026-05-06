<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AspirationSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            \App\Models\Aspiration::create([
                'user_id' => 1,
                'category_id' => rand(1, 3),
                'title' => 'Aspirasi Mahasiswa #' . $i,
                'content' => 'Ini adalah contoh isi aspirasi ke-' . $i . '. Sistem ini digunakan untuk menampung pendapat mahasiswa secara umum.'
            ]);
        }
    }
}