<?php

namespace App\Repositories;

use App\Contracts\Repositories\ArticleRepositoryContract;
use App\Dto\Article\ArticleDto;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryContract
{
    /**
     * @param string $id
     * @return array<ArticleDto>
     */
    public function getArticlesByAuthorId(string $id): array
    {
        $articles = Article::query()->where('author_id', '=', $id)->get();

        $mapped = [];

        foreach ($articles as $article) {
            $mapped[] = new ArticleDto(
                id: $article->id,
                title: $article->title,
                content: $article->content,
                isPublished: $article->is_published,
                imageUrl: $article->image_url,
                author: $article->author
            );
        }

        return $mapped;
    }
}
