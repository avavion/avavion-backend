<?php

namespace App\Contracts\Repositories;

use App\Dto\Project\GetFilteredProjectsDto;
use App\Dto\Project\ProjectDto;
use App\Dto\Project\ProjectSystemDto;

interface ProjectRepositoryContract
{
    /**
     * @param array<ProjectSystemDto> $repositories
     * @return void
     */
    public function createOrUpdate(array $repositories): void;

    /**
     * @return array<ProjectDto>
     */
    public function getAllPublishedProjects(): array;

    public function getFilteredProjects(GetFilteredProjectsDto $filter);
}
