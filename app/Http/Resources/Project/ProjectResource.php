<?php

namespace App\Http\Resources\Project;

use App\Dto\Project\ProjectDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var ProjectDto $this */
        return [
            'id' => $this->id,
            'instance_id' => $this->instanceId,
            'title' => $this->title,
            'content' => $this->content,
            'url' => $this->url,
            'stars' => $this->stars,
            'topics' => $this->topics ?? [],
            'system' => $this->system,
            'created_at' => $this->createdAt
        ];
    }
}
