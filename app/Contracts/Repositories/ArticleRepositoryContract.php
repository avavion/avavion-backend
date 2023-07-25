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

    /**
     * @param CreateArticleDto $createArticleDto
     * @return ArticleDto
     */
    public function createArticle(CreateArticleDto $createArticleDto): ArticleDto;

    /**
     * @param UpdateArticleDto $updateArticleDto
     * @return int
     */
    public function updateArticle(UpdateArticleDto $updateArticleDto): int;

    /**
     * @param RemoveArticleDto $removeArticleDto
     * @return int
     */
    public function removeArticle(RemoveArticleDto $removeArticleDto): int;

    /**
     * @param int $id
     * @return ArticleDto
     */
    public function getArticleById(int $id): ArticleDto;

    /**
     * @param ArticlePaginationDto $articlePaginationDto
     * @return ArticlePaginationResponseDto
     */
    public function getArticlesWithPagination(ArticlePaginationDto $articlePaginationDto): ArticlePaginationResponseDto;
}
