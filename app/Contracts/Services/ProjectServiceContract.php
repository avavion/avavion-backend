<?php

namespace App\Contracts\Services;

use App\Dto\Project\GetFilteredProjectsDto;
use App\Dto\Project\ProjectPaginationResponseDto;

interface ProjectServiceContract
{
    public function createOrUpdateProjectWithSystem(): bool;

    public function getFilteredProjects(GetFilteredProjectsDto $filter): ProjectPaginationResponseDto;
}
