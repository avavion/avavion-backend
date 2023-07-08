<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $author = User::factory()->create();

        return [
            'title' => $this->faker->word(),
            'content' => $this->faker->word(),
            'is_published' => $this->faker->boolean(),
            'image_path' => $this->faker->imageUrl,
            'author_id' => $author->id
        ];
    }
}
