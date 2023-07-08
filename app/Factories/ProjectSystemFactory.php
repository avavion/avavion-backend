<?php

namespace App\Factories;

use App\Enums\ProjectSystemEnum;
use App\Repositories\ProjectSystems\GitHub\GitHubRepository;
use Illuminate\Contracts\Container\BindingResolutionException;

readonly class ProjectSystemFactory
{
    /**
     * @throws BindingResolutionException
     */
    public static function getRepository(ProjectSystemEnum $system)
    {
        return match ($system) {
            ProjectSystemEnum::GITHUB => app()->make(GitHubRepository::class)
        };
    }
}
