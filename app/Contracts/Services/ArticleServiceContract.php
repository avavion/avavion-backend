<?php

namespace App\Contracts\Services;

use App\Dto\Article\ArticleDto;
use App\Dto\Article\ArticlePaginationDto;
use App\Dto\Article\ArticlePaginationResponseDto;
use App\Dto\Article\CreateArticleDto;
use App\Dto\Article\RemoveArticleDto;
use App\Dto\Article\UpdateArticleDto;

interface ArticleServiceContract
{
    /**
     * @param CreateArticleDto $articleDto
     * @return ArticleDto
     */
    public function createArticle(CreateArticleDto $articleDto): ArticleDto;

    /**
     * @param UpdateArticleDto $articleDto
     * @return int
     */
    public function updateArticle(UpdateArticleDto $articleDto): int;

    /**
     * @param RemoveArticleDto $articleDto
     * @return int
     */
    public function removeArticle(RemoveArticleDto $articleDto): int;

    /**
     * @param ArticlePaginationDto $articlePaginationDto
     * @return ArticlePaginationResponseDto
     */
    public function getArticlesWithPagination(ArticlePaginationDto $articlePaginationDto): ArticlePaginationResponseDto;

    /**
     * @param int $id
     * @return ArticleDto
     */
    public function getArticleById(int $id): ArticleDto;
}
