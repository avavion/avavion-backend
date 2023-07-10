<?php

namespace App\Dto\Project;

readonly class ProjectPaginationResponseDto
{
    public function __construct(
        public array $items,
        public bool  $hasNextPage,
        public int   $currentPage
    )
    {
    }
}