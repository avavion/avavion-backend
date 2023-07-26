<?php

namespace App\Dto\Article;

readonly class UpdateArticleDto
{
    public function __construct(
        public int    $id,
        public string $title,
        public string $content,
        public bool   $isPublished,
        public string $imageUrl,
    )
    {
    }
}
