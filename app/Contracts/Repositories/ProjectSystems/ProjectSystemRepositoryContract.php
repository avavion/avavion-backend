<?php

namespace App\Contracts\Repositories\ProjectSystems;

use App\Dto\Project\ProjectSystemDto;

interface ProjectSystemRepositoryContract
{
    /**
     * @param string $instanceId
     */
    public function getInstanceById(string $instanceId): ProjectSystemDto;

    /**
     * @return array<ProjectSystemDto>
     */
    public function getAllInstances(): array;
}