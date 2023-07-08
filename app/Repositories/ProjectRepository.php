<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Dto\Project\ProjectSystemDto;
use App\Models\Project;

readonly class ProjectRepository implements ProjectRepositoryContract
{
    /**
     * @param array<ProjectSystemDto> $repositories
     * @return void
     */
    public function createOrUpdate(array $repositories): void
    {
        foreach ($repositories as $repository) {
            Project::query()
                ->updateOrCreate([
                    'system' => $repository->system,
                    'instance_id' => $repository->instanceId,
                ], [
                    'title' => $repository->title,
                    'stars' => $repository->stars,
                    'content' => $repository->content,
                    'url' => $repository->url,
                    'system' => $repository->system,
                    'instance_id' => $repository->instanceId,
                ]);
        }
    }
}
