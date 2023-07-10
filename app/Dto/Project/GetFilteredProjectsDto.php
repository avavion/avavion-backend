<?php

namespace App\Dto\Project;

use App\Enums\ProjectSystemEnum;

readonly class GetFilteredProjectsDto
{
    public function __construct(
        public ProjectSystemEnum $type,
        public int               $currentPage = 1,
        public int               $perPage = 25,
    )
    {
    }
}
