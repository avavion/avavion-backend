<?php

namespace App\Repositories\ProjectSystems\GitHub;

use App\Contracts\Repositories\ProjectSystems\GitHub\GitHubRepositoryContract;
use App\Dto\Project\ProjectSystemDto;
use App\Enums\ProjectSystemEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

readonly class GitHubRepository implements GitHubRepositoryContract
{
    public function getInstanceById(string $instanceId): ProjectSystemDto
    {
        $username = config('projects.github', 'avavion');

        $client = Http::timeout(30);

        $response = $client->get("https://api.github.com/users/{$username}/repos");

        if (!$response->successful()) {
            throw new BadRequestException();
        }

        $repository = $response->json();

        return new ProjectSystemDto(
            instanceId: $repository['id'],
            title: $repository['full_name'],
            url: $repository['html_url'],
            system: ProjectSystemEnum::GITHUB,
            created: new Carbon($repository['created_at']),
            stars: $repository['stargazers_count'],
            content: $repository['description'] ?? null,
            isPublished: true
        );
    }

    /**
     * @return array<ProjectSystemDto>
     */
    public function getAllInstances(): array
    {
        $username = config('projects.github', 'avavion');

        $client = Http::timeout(30);

        $response = $client->get("https://api.github.com/users/{$username}/repos");

        if (!$response->successful()) {
            throw new BadRequestException();
        }

        /** @var array $repositories */
        $repositories = $response->json();

        $mapped = [];

        foreach ($repositories as $repository) {
            $mapped[] = new ProjectSystemDto(
                instanceId: $repository['id'],
                title: $repository['full_name'],
                url: $repository['html_url'],
                system: ProjectSystemEnum::GITHUB,
                created: new Carbon($repository['created_at']),
                stars: $repository['stargazers_count'],
                content: $repository['description'] ?? null,
                isPublished: true,
                topics: $repository['topics']
            );
        }

        return $mapped;
    }
}
