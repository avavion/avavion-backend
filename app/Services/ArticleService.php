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

    public function createArticle(CreateArticleDto $articleDto)
    {
        return $this->articleRepository->createArticle($articleDto);
    }

    public function updateArticle(UpdateArticleDto $articleDto)
    {
        return $this->updateArticle($articleDto);
    }

    public function removeArticle(RemoveArticleDto $articleDto)
    {
        return $this->removeArticle($articleDto);
    }

    public function getAllArticles(): ArticlePaginationResponseDto
    {
        return $this->articleRepository->getAllArticles();
    }

    public function getArticlesWithPagination(ArticlePaginationDto $articlePaginationDto): ArticlePaginationResponseDto
    {
        return $this->articleRepository->getArticlesWithPagination();
    }

    public function getArticleById(int $id): ArticleDto
    {
        return $this->articleRepository->getArticleById($id);
    }
}
