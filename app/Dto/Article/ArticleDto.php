<?php

namespace App\Dto\Article;

use App\Dto\User\UserDto;

readonly class ArticleDto
{
    public function __construct(
        public string  $id,
        public string  $title,
        public string  $content,
        public bool    $isPublished,
        public string  $imageUrl,
        public UserDto $author
    )
    {
    }
}
