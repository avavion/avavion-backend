<?php

namespace App\Repositories;

use App\Contracts\Repositories\ArticleRepositoryContract;
use App\Dto\Article\ArticleDto;
use App\Dto\Article\ArticlePaginationDto;
use App\Dto\Article\ArticlePaginationResponseDto;
use App\Dto\Article\CreateArticleDto;
use App\Dto\Article\RemoveArticleDto;
use App\Dto\Article\UpdateArticleDto;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

readonly class ArticleRepository implements ArticleRepositoryContract
{
    /**
     * @param string $id
     * @return array<ArticleDto>
     */
    public function getArticlesByAuthorId(string $id): array
    {
        $articles = Article::query()->whereAuthorId($id)->get();

        $mapped = [];

        foreach ($articles as $article) {

            $author = $article->author->modelToDto();

            $mapped[] = new ArticleDto(
                id: $article->id,
                title: $article->title,
                content: $article->content,
                isPublished: $article->is_published,
                imageUrl: $article->image_url,
                author: $author,
                updatedAt: $article->updated_at,
                createdAt: $article->created_at
            );
        }

        return $mapped;
    }

    /**
     * @param CreateArticleDto $createArticleDto
     * @return ArticleDto
     */
    public function createArticle(CreateArticleDto $createArticleDto): ArticleDto
    {
        $article = Article::query()->create([
            'title' => $createArticleDto->title,
            'content' => $createArticleDto->content,
            'image_path' => $createArticleDto->imageUrl,
            'is_published' => $createArticleDto->isPublished,
            'author_id' => $createArticleDto->author->id
        ]);

        return new ArticleDto(
            id: $article->id,
            title: $article->title,
            content: $article->content,
            isPublished: $article->is_published,
            imageUrl: $article->image_url,
            author: $article->author->modelToDto(),
            updatedAt: $article->updated_at,
            createdAt: $article->created_at
        );

    }

    /**
     * @param UpdateArticleDto $updateArticleDto
     * @return int
     */
    public function updateArticle(UpdateArticleDto $updateArticleDto): int
    {
        return Article::query()
            ->whereId($updateArticleDto->id)
            ->update([
                'title' => $updateArticleDto->title,
                'content' => $updateArticleDto->content,
                'image_path' => $updateArticleDto->imageUrl,
                'is_published' => $updateArticleDto->isPublished,
            ]);
    }

    /**
     * @param RemoveArticleDto $removeArticleDto
     * @return int
     */
    public function removeArticle(RemoveArticleDto $removeArticleDto): int
    {
        return Article::query()->whereId($removeArticleDto->id)->delete();
    }

    /**
     * @param int $id
     * @return ArticleDto
     */
    public function getArticleById(int $id): ArticleDto
    {
        $article = Article::whereId($id)->first();

        $author = $article->author->modelToDto();

        return new ArticleDto(
            id: $article->id,
            title: $article->title,
            content: $article->content,
            isPublished: $article->is_published,
            imageUrl: $article->image_url,
            author: $author,
            updatedAt: $article->updated_at,
            createdAt: $article->created_at
        );
    }

    /**
     * @param ArticlePaginationDto $articlePaginationDto
     * @return ArticlePaginationResponseDto
     */
    public function getArticlesWithPagination(ArticlePaginationDto $articlePaginationDto): ArticlePaginationResponseDto
    {
        $offset = 0;
        $limit = $articlePaginationDto->perPage;
        $currentPage = $articlePaginationDto->page;
        $hasNextPage = false;

        if ($currentPage > 1) {
            $offset = $currentPage * $limit;
        }

        $articles = Article::query()
            ->limit($limit + 1)
            ->offset($offset)
            ->orderByDesc('created_at')
            ->get();

        $mapped = [];

        foreach ($articles as $article) {
            $author = $article->author->modelToDto();

            $mapped[] = new ArticleDto(
                id: $article->id,
                title: $article->title,
                content: $article->content,
                isPublished: $article->is_published,
                imageUrl: $article->image_url,
                author: $author,
                updatedAt: $article->updated_at,
                createdAt: $article->created_at
            );
        }

        if (count($mapped) > $limit) {
            $hasNextPage = true;

            array_pop($mapped);
        }

        return new ArticlePaginationResponseDto(
            articles: $mapped,
            currentPage: $currentPage,
            perPage: $articlePaginationDto->perPage,
            hasNextPage: $hasNextPage
        );
    }
}
