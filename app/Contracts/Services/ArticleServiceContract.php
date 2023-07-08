<?php

namespace App\Contracts\Services;

use App\Dto\Article\ArticleDto;
use App\Dto\Article\ArticlePaginationResponseDto;
use App\Dto\Article\CreateArticleDto;
use App\Dto\Article\RemoveArticleDto;
use App\Dto\Article\UpdateArticleDto;

interface ArticleServiceContract
{
    public function createArticle(CreateArticleDto $articleDto);

    public function updateArticle(UpdateArticleDto $articleDto);

    public function removeArticle(RemoveArticleDto $articleDto);

    public function getAllArticles(): ArticlePaginationResponseDto;

    public function getArticleById(int $id): ArticleDto;
}
