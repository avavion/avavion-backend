<?php

namespace Tests\Feature;

use App\Console\Commands\AggregateProjects;
use App\Enums\ProjectSystemEnum;
use Tests\TestCase;

class ProjectsFeatureTest extends TestCase
{
    public function testGetFilteredProjects(): void
    {
        $this->artisan(AggregateProjects::class);

        $response = $this->get(route('projects.get', [
            'per_page' => 25,
            'type' => ProjectSystemEnum::ALL,
            'page' => 1
        ]));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'has_next_page',
                'current_page',
                'items' => [
                    [
                        'id',
                        'instance_id',
                        'title',
                        'content',
                        'url',
                        'stars',
                        'topics',
                        'system'
                    ]
                ],
            ],
            'status'
        ]);

        $responseJson = $response->json();

        $this->assertIsBool($responseJson['status']);
        $this->assertIsArray($responseJson['data']);
    }
}