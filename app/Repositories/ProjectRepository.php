<?php

namespace App\Repositories;

use App\Dto\Project\ProjectSystemDto;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectRepository
{
    /**
     * @param array<ProjectSystemDto> $repositories
     * @return void
     */
    public function createOrUpdate(array $repositories): void
    {
        foreach ($repositories as $repository) {
            Project::query()->updateOrCreate([
                'title' => $repository->title,
                'system' => $repository->system,
                'stars' => $repository->stars,
                'instanceId' => $repository->instanceId,
                'content' => $repository->content,
                'url' => $repository->url,
            ]);
        }
    }
}