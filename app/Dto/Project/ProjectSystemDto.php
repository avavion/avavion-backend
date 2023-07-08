<?php

namespace App\Dto\Project;

use App\Enums\ProjectSystemEnum;

readonly class ProjectSystemDto
{
    public function __construct(
        public int               $instanceId,
        public string            $title,
        public string            $url,
        public ProjectSystemEnum $system,
        public int               $stars = 0,
        public ?string           $content = null,
        public bool              $isPublished = true
    )
    {
    }
}