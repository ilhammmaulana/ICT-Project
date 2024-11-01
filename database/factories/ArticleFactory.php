<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $admin = User::where('email', 'admin@unsia.ac.id')->first();
        return [
            'title' => $this->faker->sentence(6),
            'slug' => $this->faker->slug,
            'body' => $this->faker->paragraphs(3, true),
            'meta_tag' => $this->faker->words(3, true),
            'meta_description' => $this->faker->sentence(10),
            'meta_title' => $this->faker->sentence(5),
            'article_category_id' => ArticleCategory::inRandomOrder()->first()->id, // Mengambil kategori acak
            'created_by' => $admin->id,
        ];
    }
    public function withImage()
    {
        return $this->afterCreating(function (Article $article) {
            $url = "https://placehold.co/600x400";
            $content = Http::get($url)->body();
            $name = Str::random(10) . '.png';
            Storage::disk('public')->put($name, $content);
            $article->update(['image' => $name]);
        });
    }
}
