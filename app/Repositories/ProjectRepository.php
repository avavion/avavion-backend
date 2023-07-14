<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Dto\Project\GetFilteredProjectsDto;
use App\Dto\Project\ProjectDto;
use App\Dto\Project\ProjectPaginationResponseDto;
use App\Dto\Project\ProjectSystemDto;
use App\Enums\ProjectSystemEnum;
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
                    'topics' => $repository->topics,
                    'created' => $repository->created->toDateTime()
                ]);
        }
    }

    /**
     * @return array<ProjectDto>
     */
    public function getAllPublishedProjects(): array
    {
        $projects = Project::query()
            ->where('is_published', '=', true)
            ->orderByDesc('system')
            ->orderByDesc('title')
            ->get();

        $mapped = [];

        /** @var Project $project */
        foreach ($projects as $project) {
            $mapped[] = new ProjectDto(
                id: $project->id,
                title: $project->title,
                content: $project->content,
                url: $project->url,
                isPublished: $project->is_published,
                stars: $project->stars,
                system: $project->system,
                instanceId: $project->instance_id,
                createdAt: $project->created,
                topics: $project->topics
            );
        }

        return $mapped;
    }

    public function getFilteredProjects(GetFilteredProjectsDto $filter): ProjectPaginationResponseDto
    {
        $offset = 0;
        $hasNextPage = false;

        $isAllType = $filter->type === ProjectSystemEnum::ALL;

        if ($filter->currentPage > 1) {
            $offset = $filter->perPage * ($filter->currentPage - 1);
        }

        $projects = Project::query()
            ->limit($filter->perPage + 1)
            ->offset($offset);

        if (!$isAllType) {
            $projects = $projects->where('system', $filter->type->value);
        }

        $projects = $projects->orderByDesc('stars')
            ->get();

        $mapped = [];

        /** @var Project $project */
        foreach ($projects as $project) {
            $mapped[] = new ProjectDto(
                id: $project->id,
                title: $project->title,
                content: $project->content,
                url: $project->url,
                isPublished: $project->is_published,
                stars: $project->stars,
                system: $project->system,
                instanceId: $project->instance_id,
                createdAt: $project->created,
                topics: $project->topics
            );
        }

        if (count($mapped) > $filter->perPage) {
            array_pop($mapped);
            $hasNextPage = true;
        }

        return new ProjectPaginationResponseDto(
            items: $mapped,
            hasNextPage: $hasNextPage,
            currentPage: $filter->currentPage,
        );
    }
}
