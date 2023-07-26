<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $author = User::factory()->create();

        return [
            'title' => $this->faker->word(),
            'content' => $this->faker->text(500),
            'is_published' => $this->faker->boolean(),
            'image_path' => UploadedFile::fake()->image('image.png')->store('public/article'),
            'author_id' => $author->id
        ];
    }
}
