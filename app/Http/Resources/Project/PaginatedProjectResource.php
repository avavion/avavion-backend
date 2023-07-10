<?php

namespace App\Http\Resources\Project;

use App\Dto\Project\ProjectPaginationResponseDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginatedProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var ProjectPaginationResponseDto $this */
        return [
            'items' => ProjectResource::collection($this->items),
            'current_page' => $this->currentPage,
            'has_next_page' => $this->hasNextPage
        ];
    }
}
