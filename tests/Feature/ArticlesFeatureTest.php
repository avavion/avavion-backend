<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ArticlesFeatureTest extends TestCase
{

    public function testGetFilteredArticles()
    {
        $response = $this->get(route('articles.get'), [
            'per_page' => 25,
            'page' => 1
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'hasNextPage',
                'currentPage',
                'perPage',
                'articles' => [
                    [
                        'id',
                        'title',
                        'content',
                        'imageUrl',
                        'isPublished',
                        'author',
                        'createdAt',
                        'updatedAt'
                    ]
                ]
            ],
        ]);
    }

    public function testGetArticle()
    {
        $article = Article::factory()->create();

        $response = $this->get(route('articles.get.id', $article->id));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'title',
                'content',
                'imageUrl',
                'isPublished',
                'author',
                'createdAt',
                'updatedAt'
            ]
        ]);
    }

    public function testCreateArticle()
    {
        $user = User::factory()->create();
        $token = $user->createToken('AppToken', ['admin'])->plainTextToken;

        $response = $this->post(
            route('articles.create'),
            [
                'title' => fake()->word,
                'content' => fake()->text(250),
                'isPublished' => fake()->boolean,
                'image' => UploadedFile::fake()->image('image.png')
            ],
            [
                'Authorization' => "Bearer $token"
            ]
        );

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'title',
                'content',
                'imageUrl',
                'isPublished',
                'author',
                'createdAt',
                'updatedAt'
            ]
        ]);
    }

    public function testUpdateArticle()
    {
        $user = User::factory()->create();
        $token = $user->createToken('AppToken', ['admin'])->plainTextToken;

        $article = Article::factory()->create();

        $response = $this->put(
            route('articles.update', $article->id),
            [
                'title' => 'Заголовок',
                'content' => 'Контентtttttttt',
                'isPublished' => true,
                'image' => UploadedFile::fake()->image('image.png')
            ],
            [
                'Authorization' => "Bearer $token"
            ]
        );

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'message'
            ]
        ]);
    }

    public function testDeleteArticle()
    {
        $user = User::factory()->create();
        $token = $user->createToken('AppToken', ['admin'])->plainTextToken;

        $article = Article::factory()->create();

        $response = $this->delete(route('articles.delete', $article->id), [],
            [
                'Authorization' => "Bearer $token"
            ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data' => [
                'message'
            ]
        ]);
    }


}
