<?php

namespace App\Dto\Article;

use App\Dto\User\UserDto;
use Illuminate\Support\Carbon;

readonly class CreateArticleDto
{
    public function __construct(
        public string  $title,
        public string  $content,
        public bool    $isPublished,
        public string  $imageUrl,
        public UserDto $author
    )
    {
    }
}