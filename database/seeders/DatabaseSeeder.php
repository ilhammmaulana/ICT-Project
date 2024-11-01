<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus semua file di dalam direktori storage
        $this->cleanStorage();

        // Panggil seeder lainnya
        $this->call([
            ArticleCategorySeeder::class,
            CourseCategorySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ArticleSeeder::class
        ]);
    }

    /**
     * Hapus semua file dalam direktori storage tertentu.
     */
    protected function cleanStorage(): void
    {
        $directory = storage_path('app/public/images'); // Ubah path sesuai kebutuhan

        if (File::exists($directory)) {
            File::cleanDirectory($directory); // Menghapus semua file di dalam direktori
        }
    }
}
