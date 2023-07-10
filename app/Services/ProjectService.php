<?php

namespace App\Services;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Contracts\Services\ProjectServiceContract;
use App\Dto\Project\GetFilteredProjectsDto;
use App\Enums\ProjectSystemEnum;
use App\Factories\ProjectSystemFactory;
use Illuminate\Contracts\Container\BindingResolutionException;

readonly class ProjectService implements ProjectServiceContract
{
    public function __construct(
        private ProjectRepositoryContract $projectRepository
    )
    {
    }

    /**
     * @throws BindingResolutionException
     */
    public function createOrUpdateProjectWithSystem(): bool
    {
        $systems = ProjectSystemEnum::getAllSystems();

        foreach ($systems as $system) {
            $systemRepository = ProjectSystemFactory::getRepository($system);

            $repositories = $systemRepository->getAllInstances();

            $this->projectRepository->createOrUpdate($repositories);
        }

        return true;
    }

    public function getFilteredProjects(GetFilteredProjectsDto $filter)
    {
        return $this->projectRepository->getFilteredProjects($filter);
    }
}
