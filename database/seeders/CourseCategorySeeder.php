<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Pemrograman Web',
            'Desain Grafis',
            'UI/UX Design',
            'Pengembangan Android',
            'Pengembangan iOS',
            'Bahasa Inggris',
            'Data Science',
            'Machine Learning',
            'Kecerdasan Buatan',
            'Pemasaran Digital',
            'Keamanan Siber',
            'Analisis Data',
            'Game Development',
            'Cloud Computing',
            'Manajemen Proyek',
            'Pengembangan Full Stack',
            'Mobile Development',
            'Teknik Mesin',
            'Akuntansi',
            'Bisnis Internasional'
        ];

        foreach ($categories as $category) {
            CourseCategory::create([
                'id' => Str::uuid(),
                'name' => $category,
            ]);
        }
    }
}
