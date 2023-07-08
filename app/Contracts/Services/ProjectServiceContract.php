<?php

namespace App\Contracts\Services;

interface ProjectServiceContract
{
    public function createOrUpdateProjectWithSystem(): bool;
}
