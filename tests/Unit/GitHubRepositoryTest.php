<?php

namespace Tests\Unit;

use App\Repositories\ProjectSystems\GitHub\GitHubRepository;
use Tests\TestCase;

class GitHubRepositoryTest extends TestCase
{
    private GitHubRepository $repo;

    public function testGetAllInstances(): void
    {
        $response = $this->repo->getAllInstances();

        $this->assertIsArray($response);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->repo = new GitHubRepository();
    }
}