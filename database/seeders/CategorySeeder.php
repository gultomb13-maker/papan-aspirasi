<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Category::create(['name' => 'Akademik']);
    \App\Models\Category::create(['name' => 'Fasilitas']);
    \App\Models\Category::create(['name' => 'Organisasi']);
    \App\Models\Category::create(['name' => 'Pelayanan']);
    }
}
