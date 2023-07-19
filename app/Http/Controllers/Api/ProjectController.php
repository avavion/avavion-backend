<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ProjectServiceContract;
use App\Dto\Project\GetFilteredProjectsDto;
use App\Enums\ProjectSystemEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\GetFilteredProjectsRequest;
use App\Http\Resources\Project\PaginatedProjectResource;
use App\Http\Resources\Project\ProjectResource;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectServiceContract $service
    )
    {
    }

    public function getFilteredProjects(GetFilteredProjectsRequest $request): JsonResponse
    {
        $response = $this->service->getFilteredProjects(new GetFilteredProjectsDto(
            type: $request->enum('type', ProjectSystemEnum::class),
            currentPage: $request->get('page', 1),
            perPage: $request->get('per_page', 25)
        ));

        return $this->sendResponse(new PaginatedProjectResource($response));
    }

    public function getProjectById(int $id)
    {
        $response = $this->service->getProjectById($id);

        return $this->sendResponse(new ProjectResource($response));
    }
}

