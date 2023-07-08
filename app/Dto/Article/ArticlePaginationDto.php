<?php

namespace App\Dto\Article;

readonly class ArticlePaginationDto
{
    public function __construct(
        public int $page = 1,
        public int $perPage = 25
    )
    {
    }
}
