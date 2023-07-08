<?php

namespace App\Contracts\Repositories;

interface ProjectRepositoryContract
{
    public function createOrUpdate(array $repositories);
}