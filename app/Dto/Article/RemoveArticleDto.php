<?php

namespace App\Dto\Article;

use App\Dto\User\UserDto;

readonly class RemoveArticleDto
{
    public function __construct(
        public int     $id,
        public UserDto $author
    )
    {
    }
}
