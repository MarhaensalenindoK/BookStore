<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    // # Seed kategori buku
    public function run(): void
    {
        $categories = [
            ['name' => 'Novel', 'slug' => 'novel', 'description' => 'Karya fiksi berupa cerita panjang yang mengisahkan kehidupan manusia.'],
            ['name' => 'Teknologi & Komputer', 'slug' => 'teknologi-komputer', 'description' => 'Buku seputar dunia teknologi, pemrograman, dan sistem informasi.'],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'description' => 'Buku teks, buku pelajaran, dan referensi akademis.'],
            ['name' => 'Bisnis & Ekonomi', 'slug' => 'bisnis-ekonomi', 'description' => 'Panduan bisnis, keuangan, dan wirausaha.'],
            ['name' => 'Self-Development', 'slug' => 'self-development', 'description' => 'Buku pengembangan diri, motivasi, dan produktivitas.'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }
    }
}
