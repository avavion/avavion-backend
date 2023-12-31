<?php

namespace App\Dto\Article;

use App\Dto\User\UserDto;
use Illuminate\Support\Carbon;

readonly class ArticleDto
{
    public function __construct(
        public string  $id,
        public string  $title,
        public string  $content,
        public bool    $isPublished,
        public string  $imageUrl,
        public UserDto $author,
        public Carbon  $updatedAt,
        public Carbon  $createdAt
    )
    {
    }
}
