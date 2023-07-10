<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ProjectServiceContract;
use App\Dto\Project\GetFilteredProjectsDto;
use App\Enums\ProjectSystemEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\GetFilteredProjectsRequest;
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
            currentPage: $request->get('current_page', 1),
            perPage: $request->get('per_page', 25)
        ));

        return $this->sendResponse($response);
    }
}
