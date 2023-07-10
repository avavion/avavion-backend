<?php

namespace App\Contracts\Services;

use App\Dto\Project\GetFilteredProjectsDto;

interface ProjectServiceContract
{
    public function createOrUpdateProjectWithSystem(): bool;

    public function getFilteredProjects(GetFilteredProjectsDto $filter);
}
