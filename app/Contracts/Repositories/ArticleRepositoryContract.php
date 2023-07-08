<?php

namespace App\Contracts\Repositories;

use App\Dto\Article\ArticleDto;
use App\Dto\Article\ArticlePaginationDto;
use App\Dto\Article\ArticlePaginationResponseDto;
use App\Dto\Article\CreateArticleDto;
use App\Dto\Article\RemoveArticleDto;
use App\Dto\Article\UpdateArticleDto;

interface ArticleRepositoryContract
{
    /**
     * @param string $id
     * @return array<ArticleDto>
     */
    public function getArticlesByAuthorId(string $id): array;

    public function createArticle(CreateArticleDto $createArticleDto);

    public function updateArticle(UpdateArticleDto $updateArticleDto);

    public function removeArticle(RemoveArticleDto $removeArticleDto);

    public function getArticleById(int $id): ArticleDto;

    public function getArticlesWithPagination(ArticlePaginationDto $articlePaginationDto): ArticlePaginationResponseDto;
}
