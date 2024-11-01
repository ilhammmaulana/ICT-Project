<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Teknologi',
            'Pendidikan',
            'Programming',
            'Kesehatan',
            'Bisnis',
            'Olahraga',
            'Seni dan Budaya',
            'Pengembangan Diri',
            'Keuangan',
            'Travel',
            'Kuliner',
            'Gaya Hidup',
            'Politik',
            'Lingkungan',
            'Sains',
            'Sejarah',
            'Fiksi',
            'Non-Fiksi',
            'Review Buku',
            'Berita',
            'Tutorial'
        ];

        foreach ($categories as $category) {
            ArticleCategory::create([
                'id' => Str::uuid(),
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
