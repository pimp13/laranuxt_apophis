<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'slug' => $this->faker->slug(3),
            'image' => $this->faker->imageUrl(),
            'summary' => $this->faker->text(150),
            'body' => $this->faker->paragraph(4),
            'visits' => rand(1, 100),
            'is_active' => true,
            'published_at' => now(),
            'meta_title' => $this->faker->text(40),
            'meta_description' => $this->faker->text(140),
            'user_id' => User::inRandomOrder()->first()->id,
            'article_category_id' => ArticleCategory::inRandomOrder()->first()->id,
        ];
    }
}
