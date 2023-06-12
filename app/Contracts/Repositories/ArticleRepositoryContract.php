<?php

namespace App\Contracts\Repositories;

use App\Dto\Article\ArticleDto;

interface ArticleRepositoryContract
{
    /**
     * @param string $id
     * @return array<ArticleDto>
     */
    public function getArticlesByAuthorId(string $id): array;
}
