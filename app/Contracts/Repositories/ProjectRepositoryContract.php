<?php

namespace App\Contracts\Repositories;

use App\Dto\Project\ProjectSystemDto;

interface ProjectRepositoryContract
{
    /**
     * @param array<ProjectSystemDto> $repositories
     * @return void
     */
    public function createOrUpdate(array $repositories): void;
}
