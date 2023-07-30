<?php

namespace App\Services;

use App\Contracts\Repositories\ArticleRepositoryContract;
use App\Contracts\Services\ArticleServiceContract;
use App\Dto\Article\ArticleDto;
use App\Dto\Article\ArticlePaginationDto;
use App\Dto\Article\ArticlePaginationResponseDto;
use App\Dto\Article\CreateArticleDto;
use App\Dto\Article\RemoveArticleDto;
use App\Dto\Article\UpdateArticleDto;

readonly class ArticleService implements ArticleServiceContract
{
    public function __construct(
        private ArticleRepositoryContract $articleRepository
    )
    {
    }

    /**
     * @param CreateArticleDto $articleDto
     * @return ArticleDto
     */
    public function createArticle(CreateArticleDto $articleDto): ArticleDto
    {
        return $this->articleRepository->createArticle($articleDto);
    }

    /**
     * @param UpdateArticleDto $articleDto
     * @return int
     */
    public function updateArticle(UpdateArticleDto $articleDto): int
    {
        return $this->articleRepository->updateArticle($articleDto);
    }

    /**
     * @param RemoveArticleDto $articleDto
     * @return int
     */
    public function removeArticle(RemoveArticleDto $articleDto): int
    {
        return $this->articleRepository->removeArticle($articleDto);
    }

    /**
     * @param ArticlePaginationDto $articlePaginationDto
     * @return ArticlePaginationResponseDto
     */
    public function getArticlesWithPagination(ArticlePaginationDto $articlePaginationDto): ArticlePaginationResponseDto
    {
        return $this->articleRepository->getArticlesWithPagination($articlePaginationDto);
    }

    /**
     * @param int $id
     * @return ArticleDto
     */
    public function getArticleById(int $id): ArticleDto
    {
        return $this->articleRepository->getArticleById($id);
    }
}
