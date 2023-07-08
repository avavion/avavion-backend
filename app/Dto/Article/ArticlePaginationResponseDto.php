<?php

namespace App\Dto\Article;

class ArticlePaginationResponseDto
{
    /**
     * @param array<ArticleDto> $articles
     * @param int $currentPage
     * @param int $perPage
     * @param bool $hasNextPage
     */
    public function __construct(
        public array $articles,
        public int   $currentPage = 1,
        public int   $perPage = 25,
        public bool  $hasNextPage = false
    )
    {
    }
}