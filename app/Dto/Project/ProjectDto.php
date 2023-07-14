<?php

namespace App\Dto\Project;

use App\Enums\ProjectSystemEnum;

readonly class ProjectDto
{
    public function __construct(
        public int               $id,
        public string            $title,
        public ?string           $content,
        public string            $url,
        public bool              $isPublished,
        public int               $stars,
        public ProjectSystemEnum $system,
        public ?string           $instanceId,
        public string            $createdAt,
        public array             $topics = []
    )
    {
    }
}
