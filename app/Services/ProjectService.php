<?php

namespace App\Services;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Enums\ProjectSystemEnum;
use App\Factories\ProjectSystemFactory;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\Container\BindingResolutionException;

class ProjectService
{
    public function __construct(
        private ProjectRepositoryContract $projectRepository
    )
    {
    }

    /**
     * @throws BindingResolutionException
     */
    public function createOrUpdate(): void
    {
        $systems = ProjectSystemEnum::getAllSystems();

        foreach ($systems as $system) {
            $systemRepository = ProjectSystemFactory::getRepository($system);

            $repositories = $systemRepository->getAllInstances();

            $this->projectRepository->createOrUpdate($repositories);
        }
    }
}