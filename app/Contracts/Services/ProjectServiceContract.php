<?php

namespace App\Contracts\Services;

use App\Dto\Project\ProjectDto;
use App\Dto\Project\GetFilteredProjectsDto;
use App\Dto\Project\ProjectPaginationResponseDto;

interface ProjectServiceContract
{
    /**
     * @return bool
     */
    public function createOrUpdateProjectWithSystem(): bool;

    /**
     * @param int $id
     * @return ProjectDto
     */
    public function getProjectById(int $id): ProjectDto;

    /**
     * @param GetFilteredProjectsDto $filter
     * @return ProjectPaginationResponseDto
     */
    public function getFilteredProjects(GetFilteredProjectsDto $filter): ProjectPaginationResponseDto;
}
